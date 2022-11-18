<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishedDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('published_designs', function (Blueprint $table) {
            $table->string('p_design_id');
            $table->string('name');
            $table->string('description');
            $table->decimal('price',10,2);
            $table->string('status');
            $table->string('reason_banned_denied')->nullable();
            $table->string('type');
            $table->string('front_design_img')->nullable();
            $table->string('back_design_img')->nullable();
            $table->json('front_design_json')->nullable();
            $table->json('back_design_json')->nullable();

            $table->string('cus_id')->index();
            $table->foreign('cus_id')->references('cus_id')
                ->on('customers')
                ->onDelete('cascade');

            $table->timestamps();
            $table->primary('p_design_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('published_designs');
    }
}
