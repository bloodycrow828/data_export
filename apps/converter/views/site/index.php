<?php
declare(strict_types=1);


/* @var $this yii\web\View */
/* @var $uploadForm UploadForm */
/* @var $downloadHasTakenPlace boolean */
/* @var $messages array */

use data_export\converter\components\exchange\forms\upload\UploadForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Загрузка данных из файла json';
?>

<div class="container">
    <div class="py-5 text-center">
        <h1>Конвертер файла json в excel(xlsx)</h1>
        <p class="lead">
            В процессе конвертации происходит проверка на соотвествие штрих-кодов стандарту EAN-13 и корректировки
            данных, utf-последловательности приводятся в читаемый вид.
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
                <ul class="text-muted">
                    Тестовые данные:
                    <li>Хост: 127.0.0.1</li>
                    <li>Логин: name</li>
                    <li>Пароль: pass</li>
                </ul>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-server" viewBox="0 0 16 16">
  <path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"/>
  <path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334c-.43.32-.931.58-1.458.79C11.81 7.684 9.967 8 8 8c-1.967 0-3.81-.317-5.21-.876a6.508 6.508 0 0 1-1.457-.79z"/>
  <path d="M14.667 11.668c-.43.319-.931.578-1.458.789-1.4.56-3.242.876-5.209.876-1.967 0-3.81-.316-5.21-.876a6.51 6.51 0 0 1-1.457-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"/>
</svg>
                    </div>
                    <input id="ftp-host" type="text" class="form-control" placeholder="Host" aria-label="Host"
                           aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-symlink"
     viewBox="0 0 16 16">
  <path d="M11.798 8.271l-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742z"/>
  <path d="M.5 3l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm.694 2.09A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09l-.636 7a1 1 0 0 1-.996.91H2.826a1 1 0 0 1-.995-.91l-.637-7zM6.172 2a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
</svg>
                        </span>
                    </div>
                    <input id="ftp-path" type="text" class="form-control" placeholder="Path"
                           aria-label="Path"
                           aria-describedby="basic-addon1" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person"
     viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
</svg>
                        </span>
                    </div>
                    <input id="ftp-login" type="text" class="form-control" placeholder="Login"
                           aria-label="Login"
                           aria-describedby="basic-addon1" required>
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
                    <input id="ftp-password" type="password" class="form-control" placeholder="Password"
                           aria-label="Password"
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
                    'enctype' => 'multipart/form-data'
                ]
            ]) ?>
            <?= $form->field($uploadForm->getFtpCredential(), 'host')->hiddenInput()->label(false) ?>

            <?= $form->field($uploadForm->getFtpCredential(), 'path')->hiddenInput()->label(false) ?>

            <?= $form->field($uploadForm->getFtpCredential(), 'login')->hiddenInput()->label(false) ?>

            <?= $form->field($uploadForm->getFtpCredential(), 'password')->hiddenInput()->label(false) ?>

            <?= $form->field($uploadForm, 'type')->hiddenInput()->label(false) ?>

            <?= $form->field($uploadForm, 'uploadedFile')->fileInput()->label(false) ?>

            <?= Html::submitButton(' Загрузить', ['class' => 'btn btn-success']) ?>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
