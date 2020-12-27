<?php
declare(strict_types=1);


namespace data_export\converter\components\exchange\domain\loaders;


use data_export\converter\components\exchange\service\generator\SheetGeneratorInterface;
use Exception;
use yii\base\Model;
use yii\helpers\ArrayHelper;

abstract class Loader
{
    protected array $errors;
    protected ?SheetGeneratorInterface $generator = null;

    public function getErrors(): array
    {
        return $this->errors ?? [];
    }

    public function setErrors(int $row, array $errors): void
    {
        $this->errors[$row] = $errors;
    }

    /**
     * Метод необходимый для правильной загрузки данных в сущность
     * @param array $data
     * @param int $rowNumber
     * @return void
     */
    abstract public function insert(array $data, int $rowNumber): void;

    /**
     * Соотношение имени полей
     * @param string $name
     * @return string
     * @throws Exception
     */
    public function getFiledName(string $name): ?string
    {
        return ArrayHelper::getValue($this->filedName(), $name);
    }

    /**
     * Валидация загружаемых данных, в случае ошибки добавляет запись для отчета
     * @param Model $form
     * @param array $data
     * @param int $rowNumber
     * @return bool
     */
    protected function validate(Model $form, array $data, int $rowNumber): bool
    {
        if ($form->load($data, '') && $form->validate()) {
            return true;
        }

        $this->setErrors($rowNumber, $form->getErrors());
        return false;
    }

    public function setGenerator(?SheetGeneratorInterface $generator): void
    {
        $this->generator = $generator;
    }

    public function getGenerator(): ?SheetGeneratorInterface
    {
        return $this->generator;
    }
}