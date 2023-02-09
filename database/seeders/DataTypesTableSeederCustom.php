<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;
use App\Models\Product;
use App\Http\Controllers\Voyager\ProductsController;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Order;
use App\Http\Controllers\Voyager\OrdersController;

class DataTypesTableSeederCustom extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'products');
        if ( ! $dataType->exists) {
            $dataType->fill([
                'name'                  => 'products',
                'display_name_singular' => 'Product',
                'display_name_plural'   => 'Products',
                'icon'                  => 'voyager-bag',
                'model_name'            => Product::class,
                'policy_name'           => null,
                'controller'            => ProductsController::class,
                'generate_permissions'  => 1,
                'description'           => '',
                'server_side'           => 1,
            ])->save();
        }

        $dataType = $this->dataType('slug', 'coupons');
        if ( ! $dataType->exists) {
            $dataType->fill([
                'name'                  => 'coupons',
                'display_name_singular' => 'Coupon',
                'display_name_plural'   => 'Coupons',
                'icon'                  => 'voyager-dollar',
                'model_name'            => Coupon::class,
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'category');
        if ( ! $dataType->exists) {
            $dataType->fill([
                'name'                  => 'category',
                'display_name_singular' => 'Category',
                'display_name_plural'   => 'Categories',
                'icon'                  => 'voyager-tag',
                'model_name'            => Category::class,
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'category-product');
        if ( ! $dataType->exists) {
            $dataType->fill([
                'name'                  => 'category_product',
                'display_name_singular' => 'Category Product',
                'display_name_plural'   => 'Category Products',
                'icon'                  => 'voyager-categories',
                'model_name'            => CategoryProduct::class,
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('name', 'orders');
        if ( ! $dataType->exists) {
            $dataType->fill([
                'slug'                  => 'orders',
                'display_name_singular' => 'Order',
                'display_name_plural'   => 'Orders',
                'icon'                  => 'voyager-documentation',
                'model_name'            => Order::class,
                'controller'            => OrdersController::class,
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
    }

    /**
     * [dataType description].
     *
     * @param $field
     * @param $for
     *
     * @return mixed [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
