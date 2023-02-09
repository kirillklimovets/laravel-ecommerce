<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    /** @test */
    public function can_get_formatted_price()
    {
        $product = Product::factory()->make([
            'name'  => 'Товар 1',
            'price' => 2499090,
        ]);

        $this->assertEquals('24 990,90 р.', formatPrice($product->price));
    }
}
