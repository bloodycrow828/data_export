<?php
declare(strict_types=1);


namespace data_export\converter\components\exchange\service;


use data_export\converter\components\exchange\domain\loaders\OrderLoader;
use data_export\converter\components\exchange\domain\Result;
use data_export\converter\components\exchange\forms\upload\UploadForm;
use League\Flysystem\FilesystemException;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\base\InvalidConfigException;

class ImportFile
{
    /**
     * @param UploadForm $uploadForm
     * @return array
     * @throws Exception
     * @throws InvalidConfigException
     * @throws FilesystemException
     */
    public function import(UploadForm $uploadForm): array
    {
        $messages = [];

        try {
            if ($uploadForm->readFile()) {
                // Парсим файл
                $result = XlsExchange::run($uploadForm->getFile(), OrderLoader::class);

                // Создаем xlsx файл
                $xlsxFile = $this->createExcelFile($result->getResult());

                // Сохраняем файл в зависимости от выбранного хранилища
                $uploader = new Uploader();
                if ($uploadForm->isFtpUpload()) {
                    $ftpCredential = $uploadForm->getFtpCredential();
                    $uploader->ftp(
                        $ftpCredential->getHost(),
                        $ftpCredential->getLogin(),
                        $ftpCredential->getPassword(),
                        $ftpCredential->getPath()
                    );
                } else {
                    $uploader->local();
                }
                $uploader->upload(file_get_contents($xlsxFile));

                return $result->getResult()->getMessages();
            }
        } catch (\Exception $exception) {
            throw $exception;
        }

        return $messages;
    }

    /**
     * Создаем файл на основании электронной таблицы
     * @param Result $result
     * @return string
     * @throws Exception
     */
    private function createExcelFile(Result $result): string
    {
        $writer = new Xlsx($result->getValue());
        $fileName = "file.xlsx";
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return $temp_file;
    }
}