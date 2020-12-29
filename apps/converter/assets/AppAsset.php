<?php

namespace data_export\converter\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/style.css',
    ];
    public $js = [
        'js/bootstrap.bundle.min.js',
        'js/common.js',
    ];
    public $jsOptions = ['position' => View::POS_END];
    public $depends = [
         'yii\web\YiiAsset',
    ];
}
