<?php

namespace App\Exports\Transactions;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FilteredTransactionsExport implements WithMultipleSheets
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function sheets(): array
    {
        return [
            new FilteredTransactionsSummarySheet($this->filters),
            new FilteredTransactionsSheet($this->filters),
        ];
    }
}
