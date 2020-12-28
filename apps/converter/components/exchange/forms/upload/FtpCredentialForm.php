<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\forms\upload;


use yii\base\Model;

class FtpCredentialForm extends Model
{
    public ?string $type = null;
    public ?string $host = null;
    public ?string $login = null;
    public ?string $password = null;
    public ?string $path = null;

    public function rules(): array
    {
        return [
            [
                'type', 'in',
                'range' => UploadForm::TYPES
            ],
            [
                ['host', 'login', 'password'], 'required',
                'when' => function () {
                    return $this->type === UploadForm::TYPE_FTP;
                },
                'whenClient' => "function (attribute, value) {
                      return $('input[name=\"safeType\"]:checked').val() === 'ftp';
                }",
            ],
            [
                ['host', 'login', 'password', 'path'], 'string'
            ],
        ];
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }
}