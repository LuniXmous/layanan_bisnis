<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Application;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;

class ApplicationExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
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
        // $kerjasama = Kerjasama::all();
        if (Auth::user()->role->id == 0) {
            $applications = Application::orderBy('updated_at', 'desc')->get();
        } else if (Auth::user()->role->id == 2) {
            $applications = Application::where("status", 1)->where("approve_status", 0)->orderBy('updated_at', 'desc')->get();
        } else if (Auth::user()->role->id == 4) {
            $applications = Application::where("status", 1)->where("approve_status", 2)->orWhere("status", ">", 1)->where("approve_status", 1)->orderBy('updated_at', 'desc')->get();
        } else if (Auth::user()->role->id == 3) {
            $applications = Application::where("status", ">", 1)->where("approve_status", 2)->orderBy('updated_at', 'desc')->get();
        } else if (Auth::user()->role->id == 5) {
            $applications = Application::where("status", 1)->where("approve_status", 3)->orderBy('updated_at', 'desc')->get();
        } else {
            $applications = Auth::user()->application;
        }

        foreach ($applications as $data) {
            $jurusan = "";
            $temp = [
                $x + 1,
                $data->title,
                $data->user->name,
                $data->activity->unit->name,
                $data->activity->category->name,
                $data->activity->name,
                $data->statusAlias()['status'],
                Carbon::parse($data->created_at)->translatedFormat('d F Y, H:i'),
                Carbon::parse($data->updated_at)->translatedFormat('d F Y, H:i'),
            ];
            $arr[$x] = $temp;
            $x++;
        }

        return $arr;
    }
    public function headings(): array
    {
        return ["No.",  "Judul Permohonan", "Nama Pemohon", "Unit/Jurusan yang Diajukan", "Kategori", "Kegiatan", "Status", "Dibuat Pada", "Terakhir Diperbarui"];
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
                foreach ($event->sheet->getColumnIterator('I') as $row) {
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
                // $event->sheet->getDelegate()->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DD4B39');
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
