<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\domain;


/** Результат парсинга файла */
class FileParseResult
{
    /** Результат выполнения */
    private bool $success;

    /** Доп. данные полученные в результате обработки */
    private Result $result;

    public function __construct(bool $success, Result $result)
    {
        $this->success = $success;
        $this->result = $result;
    }

    public function getResult(): Result
    {
        return $this->result;
    }
}
