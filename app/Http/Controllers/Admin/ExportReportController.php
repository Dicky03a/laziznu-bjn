<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ExportReportJob;

class ExportReportController extends Controller
{
    public function exportDskl()
    {
        ExportReportJob::dispatch('dskl', auth()->user());

        return back()->with('success', 'Laporan DSKL sedang diproses di latar belakang. Anda akan menerima notifikasi jika sudah selesai.');
    }

    public function exportInfaqShodaqah()
    {
        ExportReportJob::dispatch('infaq', auth()->user());

        return back()->with('success', 'Laporan Infaq Shodaqoh sedang diproses di latar belakang. Anda akan menerima notifikasi jika sudah selesai.');
    }
}
