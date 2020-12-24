<?php
declare(strict_types=1);


/* @var $this yii\web\View */
/* @var $uploadForm UploadForm */
/* @var $downloadHasTakenPlace boolean */

/* @var $messages array */

use data_export\converter\components\exchange\forms\UploadForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Загрузка данных из файла json';
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
            <h2 class="mb-3">Шаг №1</h2>
            <p class="lead">
                Выберите куда будет сохранен файл после конвертации.
            </p>
            <div class="d-block my-3">
                <div class="form-check">
                    <input id="ftp-server" name="safeType" type="radio" class="form-check-input save-type" value="ftp"
                           required>
                    <label class="form-check-label" for="ftp-server">На FTP сервер</label>
                </div>
                <div class="form-check">
                    <input id="local-server" name="safeType" type="radio" class="form-check-input save-type"
                           value="local"
                           required>
                    <label class="form-check-label" for="local-server">Локально на сервер</label>
                </div>
            </div>
        </div>

        <div class="col-md-4 order-md-2 mb-4">
            <div class="ftp-credentials invisible">
                <h4 class="d-flex justify-content-between align-items-center mb-3">Учетные данные FTP</h4>
                <p class="text-muted">
                    Логин: name
                    Пароль: pass
                </p>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="16" height="16" fill="currentColor"
                                 class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
</svg></span>
                    </div>
                    <input id="ftp-login" type="text" class="form-control" placeholder="Login" aria-label="Login"
                           aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-key" viewBox="0 0 16 16">
  <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
  <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg>
                        </span>
                    </div>
                    <input id="ftp-password" type="password" class="form-control" placeholder="Password" aria-label="Password"
                           aria-describedby="basic-addon1" required>
                </div>

            </div>
        </div>

    </div>
    <hr class="mb-4">
    <div class="row step-two invisible">
        <div class="col-md-8">
            <h2 class="mb-3">Шаг №2</h2>
            <p class="lead">
                Выберите файл с данными в формате json.
            </p>
            <?php $form = ActiveForm::begin([
                'action' => ['import'],
                'options' => [
                    'class' => 'col-md-12',
                    'enctype' => 'multipart/form-data'
                ]
            ]) ?>
            <?= $form->field($uploadForm, 'uploadType')->hiddenInput()->label(false) ?>
            <?= $form->field($uploadForm, 'ftpLogin')->hiddenInput()->label(false) ?>
            <?= $form->field($uploadForm, 'ftpPassword')->hiddenInput()->label(false) ?>
            <?= $form->field($uploadForm, 'uploadedFile')->fileInput()->label(false) ?>
            <?= Html::submitButton(' Загрузить', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
