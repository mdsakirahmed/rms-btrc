<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DueStatementExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
            $collection->operator_name,
            $collection->category_name,
            $collection->sub_category_name,
            $collection->fee_type_name,
            date('d-m-Y', strtotime($collection->period_end_date)),
        ];
    }

    public function headings(): array
    {
        return [
            'Operator name',
            'Category name',
            'Sub Category name',
            'Fee type name',
            'Period date',
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
