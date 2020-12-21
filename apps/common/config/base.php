<?php

return [
    'name' => $_ENV['APP_NAME'],
    'version' => '1.0' . ($_ENV['BUILD_NUMBER'] ? '.' . $_ENV['BUILD_NUMBER'] : ''),
    'vendorPath' => SRC_DIR . DIRECTORY_SEPARATOR . 'vendor',
    'extensions' => require SRC_DIR . DIRECTORY_SEPARATOR . 'vendor/yiisoft/extensions.php',
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru',
    'timeZone' => 'Europe/Moscow',
    'bootstrap' => [
        'log',
    ],
    'components' => [
        'errorHandler' => [
            'class' => 'baibaratsky\yii\rollbar\web\ErrorHandler',
        ],
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logVars' => [],
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@runtime/cache',
        ],
    ],
];
