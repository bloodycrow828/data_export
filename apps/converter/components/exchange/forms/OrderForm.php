<?php
declare(strict_types=1);


namespace data_export\converter\components\exchange\forms;

use data_export\converter\components\exchange\service\generator\XlsGeneratorDataInterface;
use yii\base\Model;

class OrderForm extends Model implements XlsGeneratorDataInterface
{
    public ?int $id = null;
    public ?string $barcode = null;
    public ?string $name = null;
    public ?int $quantity = null;
    public ?int $price = null;

    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['id', 'barcode', 'name', 'quantity', 'price'], 'required'],
            [['id', 'barcode', 'name', 'quantity', 'price'], 'trim'],
            [['name'], 'string', 'max' => 450],
            [['quantity', 'price'], 'integer'],
            ['barcode', 'validateEAN13']
        ];
    }

    public function validateEAN13($attribute, $params): void
    {
        $eanAsArray = array_map('intval', str_split($this->$attribute));

        if (count($eanAsArray) !== 13) {
            $this->addError($attribute, 'Длина штрихкода неверная');
            return;
        }

        $sumEven = 0;
        $sumOdd = 0;
        // Определяем и суммируем четные и не четные позиции чисел
        for ($i = 0; $i < count($eanAsArray) - 1; $i++) {
            if ($i % 2 === 0) {
                $sumOdd += $eanAsArray[$i];
            } else {
                $sumEven += $eanAsArray[$i];
            }
        }

        // сумму четных чисел умножим на 3
        $sumEven = 3 * $sumEven;
        // складываем четные и нечетные и отбрасываем десятки
        $rest = ($sumOdd + $sumEven) % 10;

        if ($rest !== 0) {
            $rest = 10 - $rest;
        }

        // убеждаемся, что контрольная сумма совпадает
        if ($rest !== $eanAsArray[12]) {
            $this->addError($attribute, 'Штрихкод неверный.');
        }
    }

    public function attributeLabels(): array
    {
        return [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }
}
