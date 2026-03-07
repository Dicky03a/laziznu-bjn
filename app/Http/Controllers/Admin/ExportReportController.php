<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportReportController extends Controller
{
    public function exportDskl()
    {
        $transactions = Transaction::where('type', 'infaq')
            ->where('status', 'confirmed')
            ->with('program')
            ->orderBy('created_at', 'asc')
            ->get();

        $totalByProgram = $transactions->groupBy('program_id')
            ->map(function ($items) {
                return [
                    'program_name' => $items->first()->program?->nama ?? 'Program Tidak Terdaftar',
                    'total' => $items->sum('jumlah'),
                    'count' => $items->count(),
                ];
            });

        $data = [
            'title' => 'DSKL Dana Sosial Keagamaan',
            'report_title' => 'LAPORAN DSKL DANA SOSIAL KEAGAMAAN',
            'transactions' => $transactions,
            'totalByProgram' => $totalByProgram,
            'grandTotal' => $transactions->sum('jumlah'),
            'generatedDate' => now(),
        ];

        $pdf = Pdf::loadView('admin.reports.laporan-pdf', $data);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);

        return $pdf->download('Laporan_DSKL_Dana_Sosial_Keagamaan_'.now()->format('d-m-Y').'.pdf');
    }

    public function exportInfaqShodaqah()
    {
        $transactions = Transaction::where('type', 'donasi')
            ->where('status', 'confirmed')
            ->with('program')
            ->orderBy('created_at', 'asc')
            ->get();

        $totalByProgram = $transactions->groupBy('program_id')
            ->map(function ($items) {
                return [
                    'program_name' => $items->first()->program?->nama ?? 'Program Tidak Terdaftar',
                    'total' => $items->sum('jumlah'),
                    'count' => $items->count(),
                ];
            });

        $data = [
            'title' => 'Infaq Shodaqoh dan Peduli Bencana',
            'report_title' => 'LAPORAN INFAQ SHODAQOH DAN PEDULI BENCANA',
            'transactions' => $transactions,
            'totalByProgram' => $totalByProgram,
            'grandTotal' => $transactions->sum('jumlah'),
            'generatedDate' => now(),
        ];

        $pdf = Pdf::loadView('admin.reports.laporan-pdf', $data);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);

        return $pdf->download('Laporan_Infaq_Shodaqoh_dan_Peduli_Bencana_'.now()->format('d-m-Y').'.pdf');
    }
}
