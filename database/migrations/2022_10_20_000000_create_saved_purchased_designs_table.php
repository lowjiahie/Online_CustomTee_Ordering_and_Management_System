<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedPurchasedDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_purchased_designs', function (Blueprint $table) {
            $table->string('p_design_id');
            $table->foreign('p_design_id')->references('p_design_id')
                ->on('published_designs')
                ->onDelete('cascade');

            $table->string('cus_id');
            $table->foreign('cus_id')->references('cus_id')
                ->on('customers')
                ->onDelete('cascade');

            $table->dateTime('sp_date_time');
            $table->timestamps();
            $table->primary(['p_design_id','cus_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saved_purchased_designs');
    }
}
