<?php

namespace App\Exports;

use App\Models\RekapDana;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use App\Models\Application;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;

class rekapDanaExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    
    public function __construct()
    {
        // $this->request = $request;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        $x = 0;
        $arr = array();
        $rekapdana = RekapDana::all(); ;

        foreach ($rekapdana as $data) {
            $temp = [
                $x + 1,
                $data->application->title,
                $data->nominal,
                $data->nilai_kontrak,
                $data->created_at,
            ];
            $arr[$x] = $temp;
            $x++;
        }

        return $arr;
    }
    public function headings(): array
    {
        return ["No.",  "Judul Permohonan", "Nilai Kontrak Yang Di Ajukan", "Nilai Kontrak Yang Disetujui", "Tanggal"];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1  => ['font' => ['bold' => true]],
            1  => ['font' => ['size' => 20]],
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                foreach ($event->sheet->getColumnIterator('D') as $row) {
                    foreach ($row->getCellIterator() as $cell) {
                        if (str_contains($cell->getValue(), '://')) {
                            $cell->setHyperlink(new Hyperlink($cell->getValue(), 'Click here to access file'));
                            // Upd: Link styling added
                            $event->sheet->getStyle($cell->getCoordinate())->applyFromArray([
                                'font' => [
                                    'color' => ['rgb' => '0000FF'],
                                    'underline' => 'single'
                                ]
                            ]);
                        }
                    }
                }
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
