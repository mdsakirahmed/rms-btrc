<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OperatorDetailExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
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
            $collection->category->name ?? '--',
            $collection->sub_category->name ?? '--',
            $collection->name,
            $collection->phone,
            $collection->email,
            $collection->website,
            $collection->address,
            $collection->note,
            $collection->contact_person_name,
            $collection->contact_person_designation,
            $collection->contact_person_phone,
            $collection->contact_person_email,
        ];
    }

    public function headings(): array
    {
        return [
            'Category',
            'Sub Category',
            'Name',
            'Phone',
            'Email',
            'Website',
            'Address',
            'Note',
            'Contact person name',
            'Contact person designation',
            'Contact person phone',
            'Contact person email',
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
