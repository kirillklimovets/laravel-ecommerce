<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

class DataRowsTableSeederCustom extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $productDataType = DataType::where('slug', 'products')->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        $dataRow = $this->dataRow($productDataType, 'id');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'name');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Название',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"validation":{"rule":"max:100"}}',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'slug');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Slug',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'details');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Характеристики',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'price');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Цена',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"validation":{"rule":"required|regex:/^\\\d*(\\\.\\\d{1,2})?$/"}}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'description');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Описание',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'featured');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'Рекомендуем',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"on":"Да","off":"Нет"}',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'image');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Изображение',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"quality":"70%","thumbnails":[{"name":"medium","scale":"50%"},{"name":"small","scale":"25%"},{"name":"cropped","crop":{"width":"300","height":"250"}}]}',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'images');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'multiple_images',
                'display_name' => 'Дополнительные изображения',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'created_at');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Создана',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'updated_at');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Изменена',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'quantity');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Количество',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        /*
        |--------------------------------------------------------------------------
        | Coupons
        |--------------------------------------------------------------------------
        */

        $couponDataType = DataType::where('slug', 'coupons')->firstOrFail();

        $dataRow = $this->dataRow($couponDataType, 'id');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($couponDataType, 'code');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Код',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($couponDataType, 'type');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Тип',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"default":"fixed","options":{"fixed":"Фиксированное значение","percent":"Процент"}}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($couponDataType, 'value');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Сумма скидки',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"null":""}',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($couponDataType, 'percent_off');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Процент скидки',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"null":""}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($couponDataType, 'created_at');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Создана',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($couponDataType, 'updated_at');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Изменена',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        /*
         |--------------------------------------------------------------------------
         | Categories
         |--------------------------------------------------------------------------
         */

        $categoryDataType = DataType::where('slug', 'category')->firstOrFail();

        $dataRow = $this->dataRow($categoryDataType, 'id');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'name');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Название',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'slug');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Slug',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'created_at');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Создана',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'updated_at');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Изменена',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        /*
         |--------------------------------------------------------------------------
         | Category Product
         |--------------------------------------------------------------------------
         */

        $categoryProductDataType = DataType::where('slug', 'category-product')->firstOrFail();

        $dataRow = $this->dataRow($categoryProductDataType, 'id');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryProductDataType, 'product_id');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id продукта',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryProductDataType, 'category_id');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id категории',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryProductDataType, 'created_at');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Создана',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryProductDataType, 'updated_at');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Изменена',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        $ordersDataType = DataType::where('slug', 'orders')->firstOrFail();

        $dataRow = $this->dataRow($ordersDataType, 'id');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'user_id');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id пользователя',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_email');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Email покупателя',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_name');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Имя покупателя',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_address_line1');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Улица и номер дома',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_address_line2');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Квартира и этаж',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_city');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Город',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_province');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Область',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_postalcode');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Почтовый индекс',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_phone');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Телефон',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_discount');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Скидка',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_discount_code');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Код купона',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_subtotal');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Стоимость товаров',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 13,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_tax');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Налог',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 14,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_total');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Итого',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 15,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'payment_gateway');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Способ оплаты',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 16,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'shipped');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'Доставлен',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '{"on":"Да","off":"Нет"}',
                'order'        => 17,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'error');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Ошибка',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 18,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'created_at');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Создана',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 19,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'updated_at');
        if ( ! $dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Изменена',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 20,
            ])->save();
        }
    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }
}
