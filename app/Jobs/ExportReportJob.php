<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Models\User;
use App\Notifications\ReportGeneratedNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ExportReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $type;

    protected User $user;

    public function __construct(string $type, User $user)
    {
        $this->type = $type;
        $this->user = $user;
    }

    public function handle(): void
    {
        if ($this->type === 'dskl') {
            $transactions = Transaction::where('type', 'infaq')
                ->where('status', 'confirmed')
                ->with('program')
                ->orderBy('created_at', 'asc')
                ->get();
            $title = 'DSKL Dana Sosial Keagamaan';
            $reportTitle = 'LAPORAN DSKL DANA SOSIAL KEAGAMAAN';
            $fileName = 'Laporan_DSKL_Dana_Sosial_Keagamaan_'.now()->format('d-m-Y_His').'.pdf';
        } else {
            $transactions = Transaction::where('type', 'donasi')
                ->where('status', 'confirmed')
                ->with('program')
                ->orderBy('created_at', 'asc')
                ->get();
            $title = 'Infaq Shodaqoh dan Peduli Bencana';
            $reportTitle = 'LAPORAN INFAQ SHODAQOH DAN PEDULI BENCANA';
            $fileName = 'Laporan_Infaq_Shodaqoh_dan_Peduli_Bencana_'.now()->format('d-m-Y_His').'.pdf';
        }

        $totalByProgram = $transactions->groupBy('program_id')
            ->map(function ($items) {
                return [
                    'program_name' => $items->first()->program?->nama ?? 'Program Tidak Terdaftar',
                    'total' => $items->sum('jumlah'),
                    'count' => $items->count(),
                ];
            });

        $data = [
            'title' => $title,
            'report_title' => $reportTitle,
            'transactions' => $transactions,
            'totalByProgram' => $totalByProgram,
            'grandTotal' => $transactions->sum('jumlah'),
            'generatedDate' => now(),
        ];

        $pdf = Pdf::loadView('admin.reports.laporan-pdf', $data);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);

        $filePath = 'reports/'.$fileName;
        Storage::disk('public')->put($filePath, $pdf->output());

        $this->user->notify(new ReportGeneratedNotification($fileName, $filePath));
    }
}
