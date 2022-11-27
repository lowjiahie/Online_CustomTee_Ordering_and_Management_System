<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('cus_id');
            $table->string("name");
            $table->string('address')->nullable();
            $table->string('phone_num')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken('access_token');
            $table->timestamps();
            $table->primary('cus_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
