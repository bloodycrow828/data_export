<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\domain;

/** Результат парсинга файла */
class FileParseResult
{
    /** Результат выполнения */
    public bool $success;

    /** @var string[] Перечень ошибок */
    public ?array $messages = null;

    public function __construct(bool $result, array $messages = null)
    {
        $this->success = $result;
        $this->messages = $messages;
    }
}
