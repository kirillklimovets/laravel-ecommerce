<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewShopPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function products_page_is_visible()
    {
        $response = $this->get('/shop');

        $response->assertStatus(200);
        $response->assertSee('Товары');
        $response->assertSee('Фильтры');
    }

    /** @test */
    public function algolia_init_script_is_existing_on_page()
    {
        $response = $this->get('/shop');

        $response->assertStatus(200);
        $response->assertSee('initializeAlgolia');
    }
}
