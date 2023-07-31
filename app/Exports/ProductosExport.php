<?php

namespace App\Exports;

use App\Models\Producto;

use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\NumberFormat;

class ProductosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    public function collection()
    {
        $productos = Producto::with('categoria')->select('titulo', 'stock', 'precio', 'id_categoria as id_categoria')->get();
        $productosArray = $productos->map(function($producto) {
            return [
                'titulo' => $producto->titulo,
                'stock' => $producto->stock,
                'precio' => $producto->precio,
                
            ];
        });
    
        return $productosArray;
    }
    

    public function headings(): array
    {
        return [
            'DESCRIPCIÓN DEL PRODUCTO',
            'CANTIDAD',
            'PRECIO',
            
        ];
    }

    public function styles(Worksheet $sheet)
    {
       
        
        // Establecer un color de fondo azul claro para los encabezados y las categorías
        $sheet->getStyle('A1:C1')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'CCE5FF',
                ],
            ],
        ]);
        $sheet->getStyle('A2:A'.$sheet->getHighestRow())->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                
            ],
        ]);
        
        // Ajustar el ancho de las columnas
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(10);
        $sheet->getColumnDimension('C')->setWidth(15);
        
        
    }
    


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                
                $categorias = Categoria::with('productos')->get();
                
                $row = 2;
                foreach ($categorias as $categoria) {
                    $event->sheet->setCellValue('A'.$row, $categoria->titulo);
                    $event->sheet->mergeCells('A'.$row.':C'.$row);
                    $event->sheet->getRowDimension($row)->setRowHeight(25);
                    $event->sheet->getStyle('A'.$row)->applyFromArray(['font' => ['bold' => true], 'fill' => ['type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'dddddd']]]);
                    $row++;
                    $productos = $categoria->productos;
                    if ($productos->count() > 0) {
                        foreach ($productos as $producto) {
                          
                            $event->sheet->setCellValue('A'.$row, $producto->titulo);
                            $event->sheet->setCellValue('B'.$row, $producto->stock);
                            $event->sheet->setCellValue('C'.$row, $producto->precio);
                          
                            $row++;
                        }
                    }
                    $spreadsheet = new Spreadsheet();

// Selecciona la hoja activa
                    $sheet = $spreadsheet->getActiveSheet();
                    $spreadsheet->getActiveSheet()
                    ->getStyle('C'.$row)
                    ->getNumberFormat()
                    ->setFormatCode('₱ #,##0.00');
                    $event->sheet->getRowDimension(1)->setRowHeight(25);
                    $event->sheet->getStyle('A1:C1')->applyFromArray(['font' => ['bold' => true], 'fill' => ['type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => '66b3ff']]]);
                    $event->sheet->getStyle('A2:C'.($event->sheet->getHighestRow()))->applyFromArray(['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['argb' => 'FF000000']]]]);
                    $event->sheet->getStyle('A1:B1')->applyFromArray(['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]]);
                 
                    $event->sheet->setCellValue('A1', 'DESCRIPCIÓN DEL PRODUCTO');
                    $event->sheet->setCellValue('B1', 'CANTIDAD');
                    $event->sheet->setCellValue('C1', 'PRECIO');
                    $event->sheet->getStyle('A2:D'.($event->sheet->getHighestRow()))->applyFromArray(['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]]);
                    $event->sheet->getStyle('A2:D'.($event->sheet->getHighestRow()))->applyFromArray(['vertical' => ['alignment' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]]);
                    $event->sheet->getStyle('A1:D'.($event->sheet->getHighestRow()))->applyFromArray(['wrapText' => true]);
                    $event->sheet->setAutoFilter('A1:C1');
                    $event->sheet->freezePane('A2');
                }
            },
            
        ];
        
    }
}
