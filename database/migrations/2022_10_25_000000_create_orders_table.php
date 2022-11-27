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
            $table->string('order_id');
            $table->string('shipping_address');
            $table->dateTime("order_date");
            $table->string('payment_method');
            $table->string('status');
            $table->decimal('totalPrice', 10, 2);
            $table->string('payment_rf_num')->nullable();

            $table->string('delivery_detail_id');
            $table->foreign('delivery_detail_id')->references('delivery_detail_id')
                ->on('delivery_details')
                ->onDelete('cascade');

            $table->string('cus_id');
            $table->foreign('cus_id')->references('cus_id')
                ->on('customers')
                ->onDelete('cascade');
            
            $table->timestamps();
            $table->primary('order_id');
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
