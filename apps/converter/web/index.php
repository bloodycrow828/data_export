<?php

use data_export\common\components\Loader;

require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'boot.php';
$loader = new Loader();
$loader->createApplication( 'converter' )->run();
