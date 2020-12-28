<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\service\generator;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class XlsGenerator
{
    private Spreadsheet $spreadsheet;

    /** Заголовок листа */
    private ?string $sheetTitle = null;

    /** Заголовки столбцов в первой строке */
    private ?array $firstRowTitles = null;

    public function __construct(Spreadsheet $spreadsheet)
    {
        $this->spreadsheet = $spreadsheet;
    }

    public function setSheetTitle(?string $sheetTitle): void
    {
        $this->sheetTitle = $sheetTitle;
    }

    public function setFirstRowTitles(?array $firstRowTitles): void
    {
        $this->firstRowTitles = $firstRowTitles;
    }

    public function generate(array $data): Spreadsheet
    {
        $spreadsheet = $this->spreadsheet;

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($this->sheetTitle);

        // Устанавливаем заголовки столбцов
        if ($this->firstRowTitles) {
            $amount = count($this->firstRowTitles);
            for ($i = 1; $i < $amount; $i++) {
                $sheet->setCellValueByColumnAndRow($i, 1, array_values($this->firstRowTitles));
            }
        }


       /* foreach ($orders as $key => $order) {
            $sheet->setCellValue('B' . $rowNumber, $key + 1);
            $sheet->mergeCells('C' . $rowNumber . ':G' . $rowNumber);
            $sheet->setCellValue(
                'C' . $rowNumber,
                $order->orderId . ' ' .
                $order->orderProductName .
                ' (комплект ' . $order->orderCirculationAmount . ' шт)'
            );
            $sheet->setCellValue('H' . $rowNumber, '');
            $sheet->setCellValue('I' . $rowNumber, 'компл');
            $sheet->setCellValue('M' . $rowNumber, '839');
        }*/

        return $spreadsheet;
    }
}