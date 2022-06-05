<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ActivityExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
            $collection->id,
            $collection->causer->name ?? 'Not Found',
            $collection->log_name,
            $collection->description,
        ];
    }

    public function headings(): array
    {
        return [
            'Activity ID',
            'User Name',
            'Action',
            'Message',
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
