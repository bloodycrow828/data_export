<?php
declare(strict_types=1);

namespace data_export\common\bootstrap;

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
    }
}