<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Topdot\Category\Models\Category;
use Topdot\Product\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(100),
            // 'slug' => $this->slug,
            'sku' => $this->faker->text(8),
            'model_number' => $this->faker->text(10),
            'qty' => $this->faker->numberBetween(1,500),
            'weight' => $this->faker->numberBetween(1,500),
            'is_active' => $this->faker->boolean(),
            'is_inStock' => $this->faker->boolean(),
            'view_count' => $this->faker->numberBetween(0,100),
            'is_featured' => $this->faker->boolean(),
            'is_recommended' => $this->faker->boolean(),
            'short_description' => $this->faker->text(200),
            'description' => $this->faker->realText(500),
            'price' => ($price = $this->faker->numberBetween(100,1000)),
            'special_price' => $this->faker->numberBetween(0,$price),
            'special_start_at' => $this->faker->dateTimeBetween( now()->subDays(100), now() ),
            'special_end_at' => $this->faker->dateTimeBetween( now(), now()->addDays(100) ),
            'meta_title' => $this->faker->name,
            'meta_description' => $this->faker->text(200)
        ];
    }

    public function configure()
    {
        $categories = Category::all();
        return $this->afterCreating(function(Product $product) use($categories){
            $url = 'https://source.unsplash.com/random/1200x800';
            $product
               ->addMediaFromUrl($url)
               ->toMediaCollection('feature');

            $product->categories()->attach(
                $categories->random( rand(0, 5 ) )->pluck('id')->toArray()
                // 387
            );
        });
    }

    public function featured()
    {
        return $this->state(function(array $attributes){
            return [
                'is_featured' => true
            ];
        });
    }

    public function notFeatured()
    {
        return $this->state(function(array $attributes){
            return [
                'is_featured' => false
            ];
        });
    }
}
