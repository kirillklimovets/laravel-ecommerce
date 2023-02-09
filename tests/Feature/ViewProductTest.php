<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_product_details()
    {
        $product = Product::factory()->create([
            'name'        => 'Ноутбук 1',
            'slug'        => 'laptop-1',
            'details'     => '15", 2TB SSD, 64GB RAM',
            'price'       => 22999090,
            'description' => 'Описание ноутбука 1',
        ]);

        $response = $this->get('/shop/'.$product->slug);

        $response->assertStatus(200);
        $response->assertSee('Ноутбук 1');
        $response->assertSee('15", 2TB SSD, 64GB RAM');
        $response->assertSee('229990.9');
        $response->assertSee('Описание ноутбука 1');
    }

    /** @test */
    public function stock_level_high()
    {
        $product = Product::factory()->create([
            'quantity' => 10,
        ]);

        $response = $this->get('/shop/'.$product->slug);

        $response->assertStatus(200);
        $response->assertSee('В наличии');
    }

    /** @test */
    public function stock_level_low()
    {
        $product = Product::factory()->create([
            'quantity' => 1,
        ]);

        $response = $this->get('/shop/'.$product->slug);

        $response->assertStatus(200);
        $response->assertSee('Осталось мало');
    }

    /** @test */
    public function stock_level_none()
    {
        $product = Product::factory()->create([
            'quantity' => 0,
        ]);

        $response = $this->get('/shop/'.$product->slug);

        $response->assertStatus(200);
        $response->assertSee('Товар закончился');
    }
}
