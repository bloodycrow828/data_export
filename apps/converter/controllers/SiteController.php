<?php
declare(strict_types=1);


namespace data_export\converter\controllers;


use yii\web\Controller;

class SiteController extends Controller
{
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return 'ok';
    }

    public function actionImport(): string
    {
        $uploadForm = new UploadForm();

        $messages = [];
        $downloadHasTakenPlace = false;
        try {
            if ($uploadForm->load(Yii::$app->request->post()) &&
                $uploadForm->uploadedFile = UploadedFile::getInstance($uploadForm, 'uploadedFile')) {
                $messages = $this->service->importFromXLS($this->getOrganizationId(), $uploadForm);
                Yii::$app->session->setFlash('success', 'Файл загружен');
                $downloadHasTakenPlace = true;
            }
        } catch (DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->render('import', [
            'model' => $uploadForm,
            'messages' => $messages,
            'downloadHasTakenPlace' => $downloadHasTakenPlace,
        ]);
    }
}