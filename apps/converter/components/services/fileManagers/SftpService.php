<?php
declare(strict_types=1);

namespace data_export\converter\components\services\fileManagers;


use League\Flysystem\FilesystemAdapter;

class SftpService
{
    private FilesystemAdapter $storage;

    public function __construct(FilesystemAdapter $storage)
    {
        $this->storage = $storage;
    }

    public function upload(string $blobFile, string $path, string $fileName): bool
    {
        $stream = fopen('php://temp', 'rb+');
        fwrite($stream, $blobFile);

        $pathVerificationServer = $path . '/' . $fileName;
        if ($this->storage->has($path . '/' . $fileName)) {
            $result = $this->storage->updateStream($pathVerificationServer, $stream);
        } else {
//            $this->storage->createDir($path);
            $result = $this->storage->writeStream($pathVerificationServer, $stream);
        }

        echo '==============' . $pathVerificationServer . PHP_EOL;
        echo '==============' . $path . '/' . $fileName . PHP_EOL;
        fclose($stream);
        unset($stream);

        if (!$result) {
            return false;
        }

        return $result;
    }

    public function findFile(string $fileName): bool
    {
        return $this->storage->has($fileName);
    }

    public function getBlobFile(string $fileName): string
    {
        return $this->storage->read($fileName);
    }

    public function remove(string $fileName): bool
    {
        try {
            $this->storage->delete($fileName);
            return true;
        } catch (\DomainException $exception) {
            return false;
        }
    }

}