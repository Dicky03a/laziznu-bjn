<?php

namespace App\Exports\PetaSebaran;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PetaSebaranExport implements WithMultipleSheets
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function sheets(): array
    {
        return [
            new PetaSebaranSummarySheet($this->filters),
            new FilteredMuzakisSheet($this->filters),
            new FilteredMustahiksSheet($this->filters),
        ];
    }
}
