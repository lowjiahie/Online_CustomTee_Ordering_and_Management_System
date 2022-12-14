<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderedCustomTeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_custom_tees', function (Blueprint $table) {
            $table->string('o_custom_tee_id');

            $table->string('plain_tee_size_id');
            $table->foreign('plain_tee_size_id')->references('plain_tee_size_id')
                ->on('plain_tee_sizes')
                ->onDelete('cascade');

            $table->string('p_method_id');
            $table->foreign('p_method_id')->references('p_method_id')
                ->on('printing_methods')
                ->onDelete('cascade');

            $table->string('o_design_id');
            $table->foreign('o_design_id')->references('o_design_id')
                ->on('ordered_designs')
                ->onDelete('cascade');

            $table->string('cus_id');
            $table->foreign('cus_id')->references('cus_id')
                ->on('customers')
                ->onDelete('cascade');

            $table->decimal('printing_method_price', 10, 2);
            $table->decimal('plain_tee_price', 10, 2);

            $table->timestamps();
            $table->primary('o_custom_tee_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordered_custom_tees');
    }
}
