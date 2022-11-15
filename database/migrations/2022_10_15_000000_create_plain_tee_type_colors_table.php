<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlainTeeTypeColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plain_tee_type_colors', function (Blueprint $table) {
            $table->string('pt_type_color_id');
            $table->binary('plain_tee_img')->nullable();

            $table->string('color_id')->index();
            $table->foreign('color_id')->references('color_id')
                ->on('colors')
                ->onDelete('cascade');

            $table->string('type_id')->index();
            $table->foreign('type_id')->references('type_id')
                ->on('types')
                ->onDelete('cascade');

            $table->timestamps();
            $table->primary('pt_type_color_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plain_tee_type_colors');
    }
}
