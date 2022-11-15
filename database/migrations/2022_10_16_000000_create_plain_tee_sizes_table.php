<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlainTeeSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plain_tee_sizes', function (Blueprint $table) {
            $table->string('plain_tee_size_id');
            $table->integer('stocks');
            $table->string('size_name');

            $table->string('pt_type_color_id')->index();
            $table->foreign('pt_type_color_id')->references('pt_type_color_id')
                ->on('plain_tee_type_colors')
                ->onDelete('cascade');

            $table->timestamps();
            $table->primary('plain_tee_size_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plain_tee_sizes');
    }
}
