<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Topdot\Category\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Deleting Categories');

        foreach (Category::all() as $category) {
            $category->delete();
        }

        $this->command->info('Creating categories');
        Category::factory()
            ->times(10)
            // ->has(
            //     Category::factory()->count(3)->has(
            //         Category::factory()->has(
            //             Category::factory()->count(3),
            //             'subCategories'
            //         )->count(3),
            //         'subCategories'
            //     ),
            //     'subCategories'
            // )
            ->create();
    }
}
