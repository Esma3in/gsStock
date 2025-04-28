<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements 
    FromCollection, 
    WithCustomStartCell, 
    WithHeadings, 
    WithColumnWidths, 
    WithStyles
{
    public function collection()
    {
        return Product::join('categories', 'categorie_id', '=', 'categories.id')
            ->join('suppliers', 'supplier_id', '=', 'suppliers.id')
            ->select(
                'products.id',
                'products.name',
                'products.description',
                'price',
                DB::raw("categories.name as category"),
                DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier")
            )
            ->get();
    }

    public function headings(): array
    {
        return ['id', 'name', 'description', 'price', 'category', 'supplier'];
    }

    public function startCell(): string
    {
        return 'C5';
    }

    public function columnWidths(): array
    {
        return [
            'C' => 20,
            'D' => 25,
            'E' => 35,
            'F' => 20,
            'G' => 25,
            'H' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Ligne des en-têtes (row 5 car startCell() = C5)
        $sheet->getStyle('C5:H5')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '333333'],
                'name' => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '999999']
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '999999']
                ],
                'Left' =>[
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color'=> ['rgb'=>'999999']

                ],
                'Right'=> [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color'=> ['rgb'=>'999999']

                ]

            ]
        ]);

        return [];
    }
}
