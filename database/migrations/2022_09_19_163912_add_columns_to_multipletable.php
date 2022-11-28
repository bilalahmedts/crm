<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMultipletable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('campaigns', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sale_records', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->softDeletes();
        }); 
        Schema::table('sale_records', function (Blueprint $table) {
            $table->integer('agent_id')->default(0);
            $table->string('credit_rating')->default(0);
            $table->string('app_date_time')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('smoker')->nullable();
            $table->string('beneficiary')->nullable();
            $table->string('major_health_issues')->nullable();
            $table->string('coverage')->nullable();
            $table->string('call_url')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes(); 
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->dropSoftDeletes(); 
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropSoftDeletes(); 
        });
        Schema::table('sale_records', function (Blueprint $table) {
            $table->dropSoftDeletes(); 
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->dropSoftDeletes(); 
        });    
        Schema::table('sale_records', function (Blueprint $table) {
            $table->dropColumn('agent_id'); 
            $table->dropColumn('credit_rating'); 
            $table->dropColumn('app_date_time'); 
            $table->dropColumn('agent_name');
            $table->dropColumn('smoker');
            $table->dropColumn('beneficiary');
            $table->dropColumn('major_health_issues');
            $table->dropColumn('coverage');
            $table->dropColumn('call_url');
            
        });
    }
}
