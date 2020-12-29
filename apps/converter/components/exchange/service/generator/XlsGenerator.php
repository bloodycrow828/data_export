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
            for ($i = 1; $i <= $amount; $i++) {
                $index = $i;
                $sheet->setCellValueByColumnAndRow($i, 1, array_values($this->firstRowTitles)[--$index]);
                $sheet->getStyleByColumnAndRow($i, 1)->getFont()->setBold(true);
            }
        }

        // Заполняем таблицу валидными данными
        $data = array_values(array_filter($data));
        $amount = count($data);
        $j = 1;
        $this->firstRowTitles ? $rowIndex = 2 : $rowIndex = 1;
        for ($i = 0; $i <= $amount; $i++) {
            foreach ($data[$i] as $item) {
                $sheet->setCellValueByColumnAndRow($j++, $i + $rowIndex, $item);
            }
            $j = 1;
        }
        unset($data);

        return $spreadsheet;
    }
}