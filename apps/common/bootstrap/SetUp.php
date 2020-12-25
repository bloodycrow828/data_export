<?php
declare(strict_types=1);

namespace data_export\common\bootstrap;

use data_export\converter\components\exchange\domain\FtpCredentials;
use yii\base\BootstrapInterface;
use yii\base\ErrorHandler;
use yii\caching\Cache;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = \Yii::$container;

        $container->setSingleton(ErrorHandler::class, static function () use ($app) {
            return $app->errorHandler;
        });

        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(FtpCredentials::class, function () {
            return new FtpCredentials(getenv('FTP_HOST'), getenv('FTP_DIR'));
        });
    }
}