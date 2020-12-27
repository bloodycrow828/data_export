<?php
declare(strict_types=1);


namespace data_export\converter\components\exchange\service\generator;


use PhpOffice\PhpSpreadsheet\Spreadsheet;

interface SheetGeneratorInterface
{
    public function generate(XlsGeneratorDataInterface $data): Spreadsheet;

}