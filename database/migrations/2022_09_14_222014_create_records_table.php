<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->integer('client_id');
           $table->integer('campaign_id');
           $table->string('first_name','70');
           $table->string('last_name','70');
           $table->string('address','200');
           $table->string('city','50');
           $table->string('state','20');
           $table->string('zipcode','5');
           $table->bigInteger('phone');
           $table->string('email')->unique();
           $table->string('lead_id','100');
           $table->string('home_owner','20');
           $table->string('property_type','40');
           $table->string('electric_bill','40');
           $table->string('electric_provider','100');
           $table->string('roof_shade','50');
           $table->string('credit_score','60');
           $table->string('income','50');
           $table->float('age', 8,2);
           $table->string('notes');
           $table->string('add_info');
           $table->string('add_info_1');
           $table->enum('status',['Active','Disable']);
           $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
