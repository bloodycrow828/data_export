<?php
declare(strict_types=1);

use data_export\common\helpers\Html;

$this->title = 'Загрузка данных из файла json';
$this->params['breadcrumbs'][] = ['label' => 'Выбор файла', 'url' => ['index']];
$this->blocks['content-header'] = Html::back(['catalog/products/']) . ' ' . $this->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="py-5 text-center">
        <h1>Конвертер файла json в excel(xlsx)</h1>
        <p class="lead">
            В процессе конвертации происходит проверка на соотвествие штрих-кодов стандарту EAN-13 и корректировки
            данных, utf-последловательности приводятся в читаемый вид
        </p>
    </div>
    <div class="row">

        <div class="col-md-8">

    </div>
</div>
