<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\domain;

use yii\base\Model;

/** Модель хранения данных о файле.*/
class File extends Model
{
    /** Расширение */
    public string $extension;

    /** Имя файла без расширения */
    public string $filename;

    /** Размер файла */
    public int $size;

    /** Полный путь к файлу */
    public string $fullName;

    /** Путь до файла */
    public string $path;

    public function rules(): array
    {
        return [
            [['extension', 'filename', 'fullName', 'size','path'], 'string'],
        ];
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    public function setSize(int $size): void
    {
        $this->size = $size;
    }
}
