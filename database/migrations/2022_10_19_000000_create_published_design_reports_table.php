<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishedDesignReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('published_design_reports', function (Blueprint $table) {
            $table->string('p_design_report_id');
            $table->string('title');
            $table->string('description');

            $table->string('cus_id')->index();
            $table->foreign('cus_id')->references('cus_id')
                ->on('customers')
                ->onDelete('cascade');

            $table->string('p_design_id')->index();
            $table->foreign('p_design_id')->references('p_design_id')
                ->on('published_designs')
                ->onDelete('cascade');

            $table->timestamps();
            $table->primary('p_design_report_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('published_design_reports');
    }
}
