<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\service;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class XlsGenerator
{

    private $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function generate(?string $managerFullName): Spreadsheet
    {
        $sumToWord = new UtfNormalizer();
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(11);
        $sheet->setTitle('Данные о заказе');

        //$sheet->setShowGridlines(false);
        //$sheet->setPrintGridlines(false);

        $sheet->setCellValue('A1', $data);

        $rowNumber = 22;
        /** @var OrderInfoDto[] $orders */
        foreach ($orders as $key => $order) {
            $rowNumber++;
            $sheet->getRowDimension($rowNumber)->setRowHeight(21.77);
            $sheet->setCellValue('B' . $rowNumber, $key + 1);
            $sheet->mergeCells('C' . $rowNumber . ':G' . $rowNumber);
            $sheet->setCellValue(
                'C' . $rowNumber,
                $order->orderId . ' ' .
                $order->orderProductName .
                ' (комплект ' . $order->orderCirculationAmount . ' шт)'
            );
            $sheet->setCellValue('H' . $rowNumber, '');
            $sheet->mergeCells('I' . $rowNumber . ':L' . $rowNumber);
            $sheet->setCellValue('I' . $rowNumber, 'компл');
            $sheet->setCellValue('M' . $rowNumber, '839');
            $sheet->setCellValue('N' . $rowNumber, '');
            $sheet->mergeCells('O' . $rowNumber . ':Q' . $rowNumber);
            $sheet->setCellValue('O' . $rowNumber, '');
            $sheet->setCellValue('R' . $rowNumber, '');
            $sheet->mergeCells('S' . $rowNumber . ':V' . $rowNumber);
            $sheet->setCellValue('S' . $rowNumber, '');
            $sheet->mergeCells('W' . $rowNumber . ':Y' . $rowNumber);
            $sheet->setCellValue('W' . $rowNumber, '1,000');
            $sheet->mergeCells('Z' . $rowNumber . ':AB' . $rowNumber);
            $sheet->setCellValue('Z' . $rowNumber, $order->totalPrice);
            $sheet->mergeCells('AC' . $rowNumber . ':AG' . $rowNumber);
            $sheet->setCellValue('AC' . $rowNumber, $order->totalPrice);
            $sheet->mergeCells('AH' . $rowNumber . ':AK' . $rowNumber);
            $sheet->setCellValue('AH' . $rowNumber, 'Без НДС');
            $sheet->mergeCells('AL' . $rowNumber . ':AN' . $rowNumber);
            $sheet->setCellValue('AL' . $rowNumber, '');
            $sheet->mergeCells('AO' . $rowNumber . ':AP' . $rowNumber);
            $sheet->setCellValue('AO' . $rowNumber, $order->totalPrice);
        }

        return $spreadsheet;
    }
}