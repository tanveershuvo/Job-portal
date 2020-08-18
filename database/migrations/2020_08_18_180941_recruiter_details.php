<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecruiterDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiter_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('address')->nullable();
            $table->string('address_2')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('company_slug')->nullable();
            $table->string('company_size', 5)->nullable();
            $table->text('about_company')->nullable();
            $table->string('logo')->nullable();
            $table->integer('premium_jobs_balance')->default(0)->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public
    function down()
    {
        Schema::dropIfExists('recruiter_details');
    }
}
