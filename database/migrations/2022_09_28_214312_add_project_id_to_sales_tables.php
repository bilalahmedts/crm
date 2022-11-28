<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectIdToSalesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('sale_records', function (Blueprint $table) {
            $table->integer('project_code')->default(0);
            $table->integer('client_code')->default(0);
            
        });
        Schema::table('sale_mortgages', function (Blueprint $table) {
            $table->integer('project_code')->default(0);
            $table->integer('client_code')->default(0);
            
        });
        Schema::table('sale_dsses', function (Blueprint $table) {
            $table->integer('project_code')->default(0);
            $table->integer('client_code')->default(0);
            
        });
        Schema::table('home_warranties', function (Blueprint $table) {
            $table->integer('project_code')->default(0);
            $table->integer('client_code')->default(0);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_records', function (Blueprint $table) {
            $table->dropColumn('project_code'); 
            $table->dropColumn('client_code'); 
        });
        Schema::table('sale_mortgages', function (Blueprint $table) {
            $table->dropColumn('project_code'); 
            $table->dropColumn('client_code'); 
        });
        Schema::table('sale_dsses', function (Blueprint $table) {
            $table->dropColumn('project_code'); 
            $table->dropColumn('client_code'); 
        });
        Schema::table('home_warranties', function (Blueprint $table) {
            $table->dropColumn('project_code'); 
            $table->dropColumn('client_code'); 
        });
    }
}
