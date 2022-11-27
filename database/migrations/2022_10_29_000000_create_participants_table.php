<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->string('competition_id');
            $table->foreign('competition_id')->references('competition_id')
                ->on('competitions')
                ->onDelete('cascade');

            $table->string('cus_id');
            $table->foreign('cus_id')->references('cus_id')
                ->on('customers')
                ->onDelete('cascade');

            $table->string('status');
            $table->string('front_design_img')->nullable();
            $table->string('back_design_img')->nullable();
            $table->json('front_design_json')->nullable();
            $table->json('back_design_json')->nullable();
            $table->timestamps();
            $table->primary(['competition_id','cus_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
