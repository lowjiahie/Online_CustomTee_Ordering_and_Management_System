<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintingMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printing_methods', function (Blueprint $table) {
            $table->string('p_method_id');
            $table->string('name');
            $table->decimal('price',10,2);
            $table->integer('minimum_order');
            $table->string('status');
            $table->timestamps();
            $table->primary('p_method_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printing_methods');
    }
}
