<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('sku');
            $table->string('model_number')->nullable();
            $table->string('name');
            $table->string('slug');

            $table->string('meta_title')->nullable();
            $table->mediumText('meta_description')->nullable();

            $table->double('price')->default(0);
            $table->double('special_price')->default(0);
            $table->timestamp('special_start_at')->nullable();
            $table->timestamp('special_end_at')->nullable();

            $table->double('qty')->default(0);
            $table->double('weight');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_inStock')->default(true);
            $table->double('viewed')->default(0);
            $table->boolean('is_recommended')->default(false);

            $table->text('short_description')->nullable();
            $table->text('description')->nullable();

            $table->longText('extra_data')->nullable();
            
            $table->timestamps();

            $table->index(['sku','model_number','name','is_active','is_inStock','is_featured','is_recommended','price'],'products_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
