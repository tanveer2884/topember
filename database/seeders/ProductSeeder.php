<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Topdot\Product\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Deleting Products');
        
        Product::all()->each(function(Product $product){
            $product->categories()->sync([]);
            $product->delete();
        });

        $this->command->info('Seeding Products');
        
        Product::factory()
            ->times(50)
            ->create();
        $this->command->info('Products Seeded');
    }
}
