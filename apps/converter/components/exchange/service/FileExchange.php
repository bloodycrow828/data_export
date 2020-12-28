<?php
declare(strict_types=1);


namespace data_export\converter\components\exchange\service;


use data_export\converter\components\exchange\domain\File;
use data_export\converter\components\exchange\domain\FileParseResult;
use data_export\converter\components\exchange\domain\loaders\Loader;
use data_export\converter\components\exchange\domain\ParseResultCollection;
use data_export\converter\components\exchange\domain\Result;
use Yii;
use yii\base\InvalidConfigException;

abstract class FileExchange
{
    /** Модель с данными по файлу */
    protected File $fileModel;

    /** Путь сохранения локального файла */
    protected string $pathToOutputXlsxFile;

    /** Загрузчик данных */
    protected Loader $loader;

    /** Обработка файла */
    abstract protected function export(): FileParseResult;

    /** Запуск обработки json файла
     * @param File $file
     * @param string $loader
     * @return FileParseResult
     * @throws InvalidConfigException
     */
    public static function run(File $file, string $loader): FileParseResult
    {
        $parser = new static();
        $parser->setFileModel($file);
        $parser->setLoader(Yii::createObject($loader));

        return $parser->export();
    }

    /**
     * Установка модели файла
     * @param File $fileModel
     */
    protected function setFileModel(File $fileModel): void
    {
        $this->fileModel = $fileModel;
    }

    /**
     * Установка модели загрузчика
     * @param Loader $loader
     */
    protected function setLoader(Loader $loader): void
    {
        $this->loader = $loader;
    }

    /**
     * Путь сохранения локального файла
     * @param string $pathToOutputXlsxFile
     */
    public function setPathToOutputXlsxFile(string $pathToOutputXlsxFile): void
    {
        $this->pathToOutputXlsxFile = $pathToOutputXlsxFile;
    }

    /**
     * Получение модели файла
     * @return File
     */
    protected function getFileModel(): File
    {
        return $this->fileModel;
    }

    /**
     * Очистка данных
     * @param string[] | string $data Данные
     * @return string[] | string
     */
    protected function trim($data)
    {
        if (is_array($data)) {
            return array_map(static function ($item) {
                if ($item === null) {
                    return null;
                }
                return is_string($item) ? trim($item) : $item;
            }, $data);
        }

        if (is_string($data)) {
            return trim($data);
        }
        return [];
    }

    /**
     * Удачное выполнение, с ошибками валидации
     * @param Result $result
     * @return FileParseResult
     */
    protected function success(Result $result): FileParseResult
    {
        return new FileParseResult(true, $result);
    }
}