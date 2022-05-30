<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Statement implements FromCollection, WithHeadings, WithMapping, WithStyles
{
       /**
    * @return \Illuminate\Support\Collection
    */
    public $collection, $selected_fee_type;
    public function __construct($collection, $selected_fee_type){
        $this->collection = $collection;
        $this->selected_fee_type = $selected_fee_type;
    }

    public function collection()
    {
        return $this->collection;
    }

    public function map($collection): array
    {
       return [
            $collection->expiration->operator->name ?? 'Not found',
            $collection->total_receivable,
            $collection->total_paid_amount(),
            $collection->total_due_amount(),
            $collection->expiration->fee_type_wise_total_due_amount($this->selected_fee_type),
        ];
    }

    public function headings(): array
    {
        return [
            'Operator name',
            'Receivable',
            'Receive',
            'Outstanding',
            'Previous Due'
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
