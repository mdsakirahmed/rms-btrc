<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VatStatementExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
       /**
    * @return \Illuminate\Support\Collection
    */
    public $collection;
    public function __construct($collection){
        $this->collection = $collection;
    }

    public function collection()
    {
        return $this->collection;
    }

    public function map($collection): array
    {
       return [
            date('d-m-Y', strtotime($collection->receive_date)),
            $collection->operator_name,
            $collection->fee_type_name,
            date('d-m-Y', strtotime($collection->period_date)),
            $collection->receive_amount,
            $collection->receive_vat,
            $collection->receive_late_fee,
            $collection->po_bank_name,
            $collection->po_number,
            date('d-m-Y', strtotime($collection->po_date)),
            $collection->deposit_journal_number,
            $collection->deposit_bank_name,
            date('d-m-Y', strtotime($collection->deposit_date)),
        ];
    }

    public function headings(): array
    {
        return [
            'Receive date',
            'Operator name',
            'Fee type name',
            'Period date',
            'Receive amount',
            'Receive vat',
            'Receive late fee',
            'Po bank name',
            'Po number',
            'Po date',
            'Deposit journal number',
            'Deposit bank name',
            'Deposit date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
