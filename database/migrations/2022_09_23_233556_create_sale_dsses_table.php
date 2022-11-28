<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDssesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_dsses', function (Blueprint $table) {
            $table->bigIncrements('id');
           $table->integer('client_id')->nullable();
           $table->integer('campaign_id')->nullable();
           $table->integer('record_id')->nullable();
           $table->bigInteger('customer_no')->nullable();
           $table->string('first_name','70')->nullable();
           $table->string('last_name','70')->nullable();
           $table->string('address','200')->nullable();
           $table->string('city','50')->nullable();
           $table->string('state','20')->nullable();
           $table->string('zipcode','5')->nullable();
           $table->bigInteger('phone')->nullable();
           $table->string('email')->nullable();
           $table->string('area','90')->nullable();
           $table->string('question_1','90')->nullable();
           $table->string('question_2','90')->nullable();
           $table->string('others_question_1','90')->nullable();
           $table->string('others_question_2','90')->nullable();
           $table->string('customer_name','90')->nullable();
           $table->string('comments','150')->nullable();
           $table->string('promo_code','90')->nullable();
           $table->timestamps();
           $table->string('user_id')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_dsses');
    }
}
