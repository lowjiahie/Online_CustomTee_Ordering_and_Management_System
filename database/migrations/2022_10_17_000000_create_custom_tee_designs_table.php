<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomTeeDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_tee_designs', function (Blueprint $table) {
            $table->string('pt_type_color_id')->index();
            $table->foreign('pt_type_color_id')->references('pt_type_color_id')
                ->on('plain_tee_type_colors')
                ->onDelete('cascade');

            $table->string('cus_id')->index();
            $table->foreign('cus_id')->references('cus_id')
                ->on('customers')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('front_design_img')->nullable();
            $table->string('back_design_img')->nullable();
            $table->json('front_design_json')->nullable();
            $table->json('back_design_json')->nullable();
            $table->timestamps();
            $table->primary(['pt_type_color_id','cus_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_tee_designs');
    }
}
