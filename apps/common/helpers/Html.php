<?php
declare(strict_types=1);

namespace data_export\common\helpers;

use yii\bootstrap4\Html as BaseHtml;
use Yii;


class Html extends BaseHtml
{
    public static function back($url = null): string
    {
        return static::a('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
</svg>',
            $url ?: Yii::$app->user->returnUrl,
            ['class' => 'btn btn-sm btn-default', 'title' => 'Назад']
        );
    }
}
