<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\ComprehensiveReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportReportController extends Controller
{
    public function exportExcel()
    {
        $fileName = 'Laporan_Komprehensif_LAZISNU_'.now()->format('d-m-Y_His').'.xlsx';
        
        return Excel::download(new ComprehensiveReportExport, $fileName);
    }
}
