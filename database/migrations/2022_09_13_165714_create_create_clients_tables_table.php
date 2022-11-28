<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateClientsTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('campaign_id');
            $table->timestamps();
        });

        Schema::create('client_posting_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->string('field_name');
            $table->string('field_value');
            $table->timestamps();
        });
        
        Schema::create('client_postings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('sale_id');
            $table->text('post_data')->nullable()->default(null);
            $table->text('post_response')->nullable()->default(null);
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
        Schema::dropIfExists('create_clients_tables');
        Schema::dropIfExists('client_posting_fields');
        Schema::dropIfExists('client_postings');
    }
}
