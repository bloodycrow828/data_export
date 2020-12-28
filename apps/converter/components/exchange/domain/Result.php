<?php
declare(strict_types=1);


namespace data_export\converter\components\exchange\domain;


use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Result
{
    private Spreadsheet $value;

    /** @var string[] Перечень ошибок */
    private array $messages;

    public function __construct(Spreadsheet $value, array $messages = [])
    {
        $this->value = $value;
        $this->messages = $messages;
    }

    public function getValue(): Spreadsheet
    {
        return $this->value;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}