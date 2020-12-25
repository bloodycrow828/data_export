<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\domain\loaders;


use data_export\converter\components\exchange\forms\OrderForm;

class OrderLoader extends Loader
{

    public function __construct()
    {
    }

    public function filedName(): array
    {
        return [
            'id' => 'Id',
            'barcode' => 'ШК',
            'name' => 'Название',
            'quantity' => 'Кол-во',
            'price' => 'Сумма',
        ];
    }

    public function insert(array $data, int $rowNumber): void
    {
        $form = new OrderForm();

        if ($this->validate($form, $data, $rowNumber)) {


        }
    }
}