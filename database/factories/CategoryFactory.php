<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Topdot\Category\Models\Category;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(10),
            'is_active' => $this->faker->boolean()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $item) {
            $url = 'https://source.unsplash.com/random/1200x800';
            $item
               ->addMediaFromUrl($url)
               ->toMediaCollection('default');
        });
    }
}
