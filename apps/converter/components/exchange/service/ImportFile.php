<?php
declare(strict_types=1);


namespace data_export\converter\components\exchange\service;


use data_export\converter\components\exchange\domain\loaders\OrderLoader;
use data_export\converter\components\exchange\forms\UploadForm;
use yii\base\InvalidConfigException;

class ImportFile
{
    /**
     * @param UploadForm $uploadForm
     * @return array
     * @throws InvalidConfigException
     */
    public function import(UploadForm $uploadForm): array
    {
        $messages = [];
        if ($uploadForm->readFile()) {
            $result = XlsExchange::run($uploadForm->getFile(), OrderLoader::class);

            return $result->messages;
        }

        return $messages;
    }
}