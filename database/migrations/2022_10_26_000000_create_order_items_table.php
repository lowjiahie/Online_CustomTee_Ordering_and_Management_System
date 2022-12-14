<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->string('order_item_id');
            $table->integer('total_qty');
            $table->string('orderItemable_id');
            $table->string("orderItemable_type");
            $table->decimal('sub_total', 10, 2);
            $table->string('order_id');
            $table->foreign('order_id')->references('order_id')
                ->on('orders')
                ->onDelete('cascade');
                
            $table->timestamps();
            $table->primary('order_item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
