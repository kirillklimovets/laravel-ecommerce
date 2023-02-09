<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = getFakePerson();
        // Insert into orders table
        $order1 = Order::create([
            'user_id'               => null,
            'billing_email'         => $person['email'],
            'billing_name'          => $person['name'],
            'billing_address_line1' => $person['line1'],
            'billing_address_line2' => $person['line2'],
            'billing_city'          => $person['city'],
            'billing_state'         => $person['state'],
            'billing_postal_code'   => $person['postalCode'],
            'billing_phone'         => $person['phone'],
            'billing_discount'      => 0,
            'billing_discount_code' => null,
            'billing_subtotal'      => 2500000,
            'billing_tax'           => 500000,
            'billing_total'         => 3000000,
            'error'                 => null,
        ]);

        // Insert into order_product table
        OrderProduct::create([
            'order_id'   => $order1->id,
            'product_id' => 1,
            'quantity'   => 1,
        ]);

        OrderProduct::create([
            'order_id'   => $order1->id,
            'product_id' => 2,
            'quantity'   => 1,
        ]);

        $person2 = getFakePerson();
        // Insert into orders table
        $order2 = Order::create([
            'user_id'               => null,
            'billing_email'         => $person2['email'],
            'billing_name'          => $person2['name'],
            'billing_address_line1' => $person2['line1'],
            'billing_address_line2' => $person2['line2'],
            'billing_city'          => $person2['city'],
            'billing_state'         => $person2['state'],
            'billing_postal_code'   => $person2['postalCode'],
            'billing_phone'         => $person2['phone'],
            'billing_discount'      => 0,
            'billing_discount_code' => null,
            'billing_subtotal'      => 3000000,
            'billing_tax'           => 600000,
            'billing_total'         => 3600000,
            'error'                 => null,
        ]);

        // Insert into order_product table
        OrderProduct::create([
            'order_id'   => $order2->id,
            'product_id' => 3,
            'quantity'   => 1,
        ]);

        OrderProduct::create([
            'order_id'   => $order2->id,
            'product_id' => 4,
            'quantity'   => 1,
        ]);

        $person3 = getFakePerson();
        // Insert into orders table
        $order3 = Order::create([
            'user_id'               => null,
            'billing_email'         => $person3['email'],
            'billing_name'          => $person3['name'],
            'billing_address_line1' => $person3['line1'],
            'billing_address_line2' => $person3['line2'],
            'billing_city'          => $person3['city'],
            'billing_state'         => $person3['state'],
            'billing_postal_code'   => $person3['postalCode'],
            'billing_phone'         => $person3['phone'],
            'billing_discount'      => 0,
            'billing_discount_code' => null,
            'billing_subtotal'      => 3500000,
            'billing_tax'           => 700000,
            'billing_total'         => 4200000,
            'error'                 => null,
        ]);

        // Insert into order_product table
        OrderProduct::create([
            'order_id'   => $order3->id,
            'product_id' => 5,
            'quantity'   => 1,
        ]);

        OrderProduct::create([
            'order_id'   => $order3->id,
            'product_id' => 6,
            'quantity'   => 1,
        ]);
    }
}
