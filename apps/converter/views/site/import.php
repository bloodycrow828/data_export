<?php
declare(strict_types=1);

use data_export\common\helpers\Html;

/** @var $messages array */


$this->title = 'Загрузка данных из файла json';
$this->params['breadcrumbs'][] = ['label' => ' / Выбор файла / ', 'url' => ['index']];
$this->blocks['content-header'] = Html::back(['site/index/']) . ' / ' . $this->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="py-5 text-center">
        <h1>Конвертер файла json в excel(xlsx)</h1>
    </div>
    <?php if (!empty($messages)): ?>
        <div class="row">
            <div class="col-md-12">
                <h3>Во время загрузки обнаружены ошибки</h3>
                <div>
                    <?php foreach ($messages as $str => $fields): ?>
                        <h4>Товар # <?= $str ?></h4>
                        <ul class="list-group">
                            <?php foreach ($fields as $name => $message): ?>
                                <li class="list-group-item"><?= $name . ': ' . current($message) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <h3>Загрузка прошла успешно</h3>
            </div>
            <div>
                <h3>Ошибок не обнаружено</h3>
            </div>
        </div>
    <?php endif; ?>

</div>
