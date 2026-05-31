<?php

namespace App\Exports\Qurban;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FilteredQurbanExport implements WithMultipleSheets
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function sheets(): array
    {
        return [
            new FilteredQurbanSummarySheet($this->filters),
            new FilteredQurbanRegistrationsSheet($this->filters),
        ];
    }
}
