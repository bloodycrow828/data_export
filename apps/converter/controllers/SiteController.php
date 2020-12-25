<?php
declare(strict_types=1);


namespace data_export\converter\controllers;


use data_export\converter\components\exchange\forms\UploadForm;
use data_export\converter\components\exchange\service\ImportFile;
use Exception;
use Yii;
use yii\base\Module;
use yii\web\Controller;
use yii\web\ErrorHandler;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    private ErrorHandler $errorHandler;
    private ImportFile $importFile;

    public function __construct(
        $id, Module $module,
        ErrorHandler $errorHandler,
        ImportFile $importFile,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->errorHandler = $errorHandler;
        $this->importFile = $importFile;
    }

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
        $uploadForm = new UploadForm();

        return $this->render('index', [
            'uploadForm' => $uploadForm,
        ]);
    }

    public function actionImport(): string
    {
        $uploadForm = new UploadForm();

        $messages = [];
        try {
            if ($uploadForm->load(Yii::$app->request->post()) &&
                $uploadForm->uploadedFile = UploadedFile::getInstance($uploadForm, 'uploadedFile')
            ) {
                $messages = $this->importFile->import($uploadForm);
                Yii::$app->session->setFlash('success', 'Файл загружен, конвертация выполнена.');
            }
        } catch (Exception $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->render('import', [
            'model' => $uploadForm,
            'messages' => $messages,
        ]);
    }
}