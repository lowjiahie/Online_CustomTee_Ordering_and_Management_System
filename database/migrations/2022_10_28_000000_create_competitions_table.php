<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->string('competition_id');
            $table->string('topic');
            $table->string('description');
            $table->string('rules');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->string('winner')->nullable();
            
            $table->string('staff_id');
            $table->foreign('staff_id')->references('staff_id')
                ->on('staff')
                ->onDelete('cascade');

            $table->timestamps();
            $table->primary('competition_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitions');
    }
}
