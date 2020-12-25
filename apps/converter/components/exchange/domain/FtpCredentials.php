<?php
declare(strict_types=1);


namespace data_export\converter\components\exchange\domain;


class FtpCredentials
{
    private string $ftpHost;
    private string $ftpDir;
    private string $ftpLogin;
    private string $ftpPassword;

    public function __construct(string $ftpHost, string $ftpDir)
    {
        $this->ftpHost = $ftpHost;
        $this->ftpDir = $ftpDir;
    }

    public function setFtpLogin(string $ftpLogin): void
    {
        $this->ftpLogin = $ftpLogin;
    }

    public function setFtpPassword(string $ftpPassword): void
    {
        $this->ftpPassword = $ftpPassword;
    }

    public function getFtpHost(): string
    {
        return $this->ftpHost;
    }

    public function getFtpDir(): string
    {
        return $this->ftpDir;
    }

    public function getFtpLogin(): string
    {
        return $this->ftpLogin;
    }

    public function getFtpPassword(): string
    {
        return $this->ftpPassword;
    }
}