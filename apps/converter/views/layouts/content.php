<?php

use yii\widgets\Breadcrumbs;

/** @var string $content */
?>
<section class="content">
    <?= Breadcrumbs::widget(
        ['links' => $this->params['breadcrumbs'] ?? []]
    ) ?>
    <?= $content ?>
</section>
