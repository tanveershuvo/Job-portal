<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('package_id')->unsigned();
            $table->string('package_name');
            $table->integer('premium_jobs');
            $table->string('email');
            $table->double('amount');
            $table->string('status')->nullable();
            $table->string('session_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_option');
            $table->string('payment_method')->nullable();
            $table->string('currency');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('package_id')
                ->references('id')->on('pricings')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
