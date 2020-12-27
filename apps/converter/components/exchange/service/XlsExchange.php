<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\service;


use data_export\converter\components\exchange\domain\FileParseResult;
use data_export\converter\components\exchange\service\generator\XlsGeneratorByOrderFactory;

class XlsExchange extends FileExchange
{
    private XlsGeneratorByOrderFactory $xlsGenerator;

    public function __construct()
    {
        $this->xlsGenerator = new XlsGeneratorByOrderFactory();
    }

    /** Чтение данных из Json */
    public function read(): array
    {
        $jsonFile = file_get_contents($this->getFileModel()->getFullName());
        return json_decode($jsonFile, true);
    }

    public function export(): FileParseResult
    {
        $content = $this->read();
        if (count($content['items']) > 0) {
            $this->loader->setGenerator($this->xlsGenerator->createXlsGenerator());

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

            usort($data, function ($one, $two) {
                return $two['price'] <=> $one['price'];
            });

            foreach ($data as $item) {
                $this->loader->insert($item, (int)$item['id']);
            }

        }

        return $this->success($this->loader->getErrors());
    }
}