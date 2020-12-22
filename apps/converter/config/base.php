<?php

use data_export\common\bootstrap\SetUp;

return [
    'class' => 'yii\web\Application',
    'id' => 'converter',
    'name' => 'data_converter',
    'basePath' => CONVERTER_APP_DIR,
    'defaultRoute' => 'site/index',
    'controllerNamespace' => 'data_export\converter\controllers',
    'bootstrap' => [
        SetUp::class
    ],
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
        ],
        'user' => [
            'identityClass' => false,
            'enableAutoLogin' => true,
            'enableSession' => false,
        ],
        'urlManager' => require __DIR__ . '/urlManager.php',
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
];
