<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\forms\upload;


use yii\base\Model;

class LocalCredentialForm extends Model
{
    public ?string $path = null;

    public function rules(): array
    {
        return [
            [['path'], 'string'],
        ];
    }

    public function getPath(): ?string
    {
        return $this->path;
    }
}