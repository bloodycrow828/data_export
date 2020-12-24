<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\forms;


use data_export\converter\components\exchange\domain\File;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public ?string $ftpLogin = null;
    public ?string $ftpPassword = null;
    public ?string $uploadType = null;

    private File $file;
    public ?UploadedFile $uploadedFile = null;

    public function rules(): array
    {
        return [
            [['ftpLogin', 'ftpPassword'], 'string'],
            [
                'uploadType', 'in',
                'range' => ['ftp', 'local'],
                'message' => 'Некорректный тип загрузки',
            ],
            [['uploadedFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'json'],
        ];
    }

    public function readFile(): bool
    {
        if ($this->validate()) {
            $this->file = new File(['fullName' => $this->uploadedFile->tempName]);
            return true;
        }
        return false;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function getFtpLogin(): ?string
    {
        return $this->ftpLogin;
    }

    public function getFtpPassword(): ?string
    {
        return $this->ftpPassword;
    }

    public function attributeLabels(): array
    {
        return [];
    }
}