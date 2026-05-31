<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ComprehensiveReportExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new SummarySheetExport(),
            new ProgramsSheetExport(),
            new TransactionsSheetExport(),
            new DistributionProgramsSheetExport(),
            new QurbanRegistrationsSheetExport(),
            new MustahiksSheetExport(),
        ];
    }
}
