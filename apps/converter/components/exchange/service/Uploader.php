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

class Uploader
{
    private FilesystemAdapter $adapter;
    private ?string $path = null;

    public function ftp(string $host, string $login, string $password, string $path = null): void
    {
        $this->path = $path;
        $this->adapter = new FtpAdapter(
            new FtpConnectionOptions(
                $host,
                !empty($this->path) ? $this->path : '/',
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

    public function local(string $path): void
    {
        $this->path = $path;
        //                         __DIR__ . '/root/directory/'
        $this->adapter = new LocalFilesystemAdapter(
            $path,
            PortableVisibilityConverter::fromArray([
                'file' => [
                    'public' => 0640,
                    'private' => 0644,
                ],
                'dir' => [
                    'public' => 0750,
                    'private' => 7755,
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