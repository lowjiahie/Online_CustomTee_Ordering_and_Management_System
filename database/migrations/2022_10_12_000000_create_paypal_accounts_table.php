<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_accounts', function (Blueprint $table) {
            $table->string('paypal_acc_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email_id');
            $table->string('phone_num')->nullable();
            
            $table->string('cus_id')->index();
            $table->foreign('cus_id')->references('cus_id')
                    ->on('customers')
                    ->onDelete('cascade');

            $table->timestamps();
            $table->primary('paypal_acc_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paypal_accounts');
    }
}
