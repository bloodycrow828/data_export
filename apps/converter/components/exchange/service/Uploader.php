<?php
declare(strict_types=1);


namespace data_export\converter\components\exchange\service;


use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\FilesystemException;
use League\Flysystem\Ftp\FtpAdapter;
use League\Flysystem\Ftp\FtpConnectionOptions;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
use Yii;

class Uploader
{
    private FilesystemAdapter $adapter;

    public function ftp(string $host, string $login, string $password, string $path = null): void
    {
        $this->adapter = new FtpAdapter(
            new FtpConnectionOptions(
                $host,
                !empty($path) ? $path : '/',
                $login,
                $password,
                $port = 21,
                $ssl = false,
                $timeout = 90,
                $utf8 = true,
                $passive = false
            )
        );
    }

    public function local(): void
    {
        $this->adapter = new LocalFilesystemAdapter(
//            Yii::getAlias('@web/public/'),
            CONVERTER_APP_DIR.'/web/public',
            PortableVisibilityConverter::fromArray([
                'file' => [
                    'public' => 0640,
                    'private' => 0644,
                ],
                'dir' => [
                    'public' => 0755,
                    'private' => 0755,
                ],
            ]),
            LOCK_EX,
        );
    }

    /**
     * @param string $content
     * @throws FilesystemException
     */
    public function upload(string $content)
    {
        try {
            $filesystem = new Filesystem($this->adapter);
            $filesystem->write('items.xlsx', $content);
        } catch (FilesystemException $exception) {
            throw $exception;
        }
    }
}