<?php

use converter\bootstrap\SetUp;

return [
    'class' => 'yii\web\Application',
    'id' => 'converter',
    'name' => 'data_converter',
    'basePath' => CONVERTER_APP_DIR,
    'defaultRoute' => 'site/index',
    'controllerNamespace' => 'converter\controllers',
    'bootstrap' => [
        'log',
        SetUp::class
    ],
    'components' => [
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => getenv('COOKIE_VALIDATION_KEY'),
        ],
        'user' => false,
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
