<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('coupon_id')->nullable();

            $table->double('subtotal')->default(0);
            $table->double('discount')->default(0);
            $table->double('shipping')->default(0);
            $table->double('tax')->default(0);
            $table->double('total')->default(0);
            $table->string('shipping_name')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_address2')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')-> nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_zipCode')->nullable();

            $table->string('billing_name')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_address2')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('billing_zipCode')->nullable();

            $table->boolean('is_billing_same_as_shipping')->default(true);

            $table->string('payment_info_name')->nullable();
            $table->string('payment_info_card_number')->nullable();
            $table->string('payment_info_expiry')->nullable();
            $table->string('payment_info_card_type')->nullable();
            $table->string('payment_profile_id')->nullable();
            $table->string('tracking_number')->nullable();

            $table->longText('cart')->nullable();
            $table->string('status')->default('new')->comment('processing,completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
