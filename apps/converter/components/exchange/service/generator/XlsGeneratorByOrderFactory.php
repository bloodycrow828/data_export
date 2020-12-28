<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\service\generator;


use PhpOffice\PhpSpreadsheet\Spreadsheet;

class XlsGeneratorByOrderFactory
{
    private ?XlsGenerator $xlsGenerator = null;

    public function createXlsGenerator(): XlsGenerator
    {
        if ($this->xlsGenerator === null) {
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
            $spreadsheet->getDefaultStyle()->getFont()->setSize(11);

            $generator = new XlsGenerator($spreadsheet);
            $generator->setSheetTitle('Данные о заказе');

            return $generator;
        }

        return $this->xlsGenerator;
    }
}