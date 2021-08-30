<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Topdot\Product\Models\Product;

/**
 * @ignore
 */
class OrderFrontendTest extends TestCase
{
    public function featured_products_showing_on_homepage()
    {
        // $notFeaturedProducts = Product::factory()->count(2)->notFeatured()->create();
        $featuredProdcuts = Product::factory()->count(2)->featured()->create();

        $response = $this->get('/');

        foreach ($featuredProdcuts as $product) {
            $response->assertSee($product->name);
        }
    }
}
