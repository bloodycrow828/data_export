<?php
declare(strict_types=1);

use data_export\converter\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html dir="ltr" lang="ru">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title><?= Html::encode($this->title) ?></title>
    <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical"/>
    <?php $this->head() ?>
</head>
<body class="bg-light">
<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


