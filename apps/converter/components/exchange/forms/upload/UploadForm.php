<?php
declare(strict_types=1);


namespace data_export\converter\components\exchange\forms\upload;


use data_export\common\forms\CompositeForm;
use data_export\converter\components\exchange\domain\File;
use yii\web\UploadedFile;

/**
 * Модель ввода данных при загрузке файла
 *
 * @property FtpCredentialForm $ftpCredential;
 */
class UploadForm extends CompositeForm
{
    public const TYPE_FTP = 'ftp';
    public const TYPE_LOCAL = 'local';
    public const TYPES = [
        self::TYPE_FTP,
        self::TYPE_LOCAL
    ];

    private File $file;
    public ?UploadedFile $uploadedFile = null;
    public ?string $type = null;

    public function __construct($config = [])
    {
        $this->ftpCredential = new FtpCredentialForm();

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [
                'type', 'in',
                'range' => self::TYPES,
                'message' => 'Тип загрузки не соответствует доступным.'
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

    public function getFtpCredential(): FtpCredentialForm
    {
        return $this->ftpCredential;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function attributeLabels(): array
    {
        return [];
    }

    public function isFtpUpload(): bool
    {
        return $this->type === self::TYPE_FTP;
    }

    protected function internalForms(): array
    {
        return ['ftpCredential', 'localCredential'];
    }
}