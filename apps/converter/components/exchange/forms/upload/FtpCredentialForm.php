<?php
declare(strict_types=1);


namespace data_export\converter\components\exchange\forms\upload;


use yii\base\Model;

class FtpCredentialForm extends Model
{
    private const TYPE_FTP = 'ftp';
    private const TYPE_LOCAL = 'local';
    private const TYPES = [
        self::TYPE_FTP,
        self::TYPE_LOCAL
    ];

    public ?string $type = null;
    public ?string $host = null;
    public ?string $login = null;
    public ?string $password = null;
    public ?string $path = null;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [
                'type', 'in',
                'range' => self::TYPES
            ],
            [
                ['host', 'login', 'password', 'path'], 'required',
                'when' => function () {
                      return $this->type === self::TYPE_FTP;
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


}