<?php

error_reporting(0);
ini_set('display_errors', 0);

// Пути к исходникам
defined('SRC_DIR') or define('SRC_DIR', dirname(__DIR__));
defined('APPS_DIR') or define('APPS_DIR', SRC_DIR . '/apps');
defined('COMMON_APP_DIR') or define('COMMON_APP_DIR', APPS_DIR . DIRECTORY_SEPARATOR . 'common');
defined('CONVERTER_APP_DIR') or define('CONVERTER_APP_DIR', APPS_DIR . DIRECTORY_SEPARATOR . 'converter');

require SRC_DIR . '/vendor/autoload.php';

require_once __DIR__.'/env.php';

if (getenv('APP_ENV') == 'DEV') {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
} else {
    defined('YII_DEBUG') or define('YII_DEBUG', false);
    defined('YII_ENV') or define('YII_ENV', 'prod');
}

require SRC_DIR . '/vendor/yiisoft/yii2/Yii.php';

require 'common/components/Loader.php';
