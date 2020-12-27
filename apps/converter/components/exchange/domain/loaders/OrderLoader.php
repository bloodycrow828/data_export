<?php
declare(strict_types=1);

namespace data_export\converter\components\exchange\domain\loaders;


use data_export\converter\components\exchange\forms\OrderForm;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OrderLoader extends Loader
{
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

            $spreadsheet = $this->getGenerator()->generate($form);

            // Создаем файл на основании электронной таблицы
            $writer = new Xlsx($spreadsheet);
            $fileName = "file.xlsx";
            $temp_file = tempnam(sys_get_temp_dir(), $fileName);
            $writer->save($temp_file);

        }
    }


}