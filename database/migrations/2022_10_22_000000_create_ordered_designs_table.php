<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderedDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_designs', function (Blueprint $table) {
            $table->string('o_design_id');
            $table->string('name');
            $table->string('front_design_img')->nullable();
            $table->string('back_design_img')->nullable();
            $table->json('front_design_json')->nullable();
            $table->json('back_design_json')->nullable();
            $table->timestamps();
            $table->primary('o_design_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordered_designs');
    }
}
