<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\service;


use data_export\converter\components\exchange\domain\FileParseResult;
use data_export\converter\components\exchange\domain\loaders\OrderLoader;
use data_export\converter\components\exchange\domain\Result;
use data_export\converter\components\exchange\service\generator\XlsGeneratorByOrderFactory;

class XlsExchange extends FileExchange
{
    private XlsGeneratorByOrderFactory $xlsGenerator;

    public function __construct()
    {
        $this->xlsGenerator = new XlsGeneratorByOrderFactory();
    }

    public function export(): FileParseResult
    {
        $spreadsheet = null;
        $content = $this->read();

        if (count($content['items']) > 0) {

            $data = [];
            foreach ($content['items'] as $keyItem => $item) {
                if (isset($item['quantity'])) {
                    $data[$keyItem]['quantity'] = $item['quantity'];
                }
                if (isset($item['price'])) {
                    $data[$keyItem]['price'] = $item['price'];
                }
                if (isset($item['item'])) {
                    foreach ($item['item'] as $key => $value) {
                        $data[$keyItem][$key] = $this->trim($value);
                    }
                }
            }
            unset($content);

            // сортируем данные по цене
            usort($data, function ($one, $two) {
                return $two['price'] <=> $one['price'];
            });

            // валидируем и подготавливаем данные
            $validData = [];
            foreach ($data as $item) {
                $validData[] = $this->loader->insert($item, (int)$item['id']);
            }
            unset($data);

            $generator = $this->xlsGenerator->createXlsGenerator();
            $generator->setFirstRowTitles(OrderLoader::filedName());

            $spreadsheet = $generator->generate($validData);
        };

        return $this->success(new Result($spreadsheet, $this->loader->getErrors()));
    }

    /** Чтение данных из Json */
    private function read(): array
    {
        $jsonFile = file_get_contents($this->getFileModel()->getFullName());
        return json_decode($jsonFile, true);
    }
}