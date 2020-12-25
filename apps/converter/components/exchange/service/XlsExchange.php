<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\service;


use data_export\converter\components\exchange\domain\FileParseResult;

class XlsExchange extends FileExchange
{

    /**
     * Чтение данных из Json
     */
    public function export(): FileParseResult
    {
        file_get_contents($this->getFileModel()->getFullName());

            $objPHPExcel = $objReader->load($this->getFileModel()->getFullName());

            $this->calculateRowTotalCount($objPHPExcel);
            $i = 0;
            //проходим все листы в документе
            while ($i < $objPHPExcel->getSheetCount()) {
                $sheet = $objPHPExcel->getSheet($i);
                //последняя строка
                $highestRow = $sheet->getHighestRow() - 1;
                //последний столбец
                $highestColumn = $sheet->getHighestColumn();

                $row = 0;
                $rowHeader = '';
                //построчное чтение листа и его загрузка в бд
                while ($row <= $highestRow) {
                    //получаем заголовки. По умолчанию считаем, что первая строка всегда заголовки
                    if (++$row === 1) {
                        $rowHeader = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                            NULL, FALSE,
                            FALSE);
                        $rowHeader = $this->transliterate(array_filter(current($rowHeader)));
                        continue;
                    }
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                        NULL, FALSE, FALSE);
                    // комбинируем название поля со сзначением
                    $this->loader->insert(array_combine($rowHeader,
                        $this->trim(array_slice(current($rowData), 0, count($rowHeader)))
                    ), $row);
                }
                $i++;
            }
            return $this->success($this->loader->getErrors());
    }
}