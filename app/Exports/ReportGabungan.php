<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ReportGabungan implements FromView, ShouldAutoSize, WithEvents
{
    protected $data;
    /**
     * @return \Illuminate\Support\Collection
     */

    function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('generate.laporan_gabungan_excel', $this->data);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {

                // Apply array of styles to B2:G8 cell range
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ]
                ];

                $highestRow = $event->sheet->getDelegate()->getHighestRow();
                $lastTableRow = $highestRow - 5;
                $event->sheet->getDelegate()->getStyle('A22:M' . $highestRow-7)->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('J' . $lastTableRow . ':L' . $highestRow)->applyFromArray($styleArray);
            },
        ];
    }
}
