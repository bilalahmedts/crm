<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('pseudo_name',125)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('cnic',20)->nullable();
            $table->string('address',190)->nullable();
            $table->integer('campaign_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->integer('employement_type_id')->nullable();
            $table->integer('reporting_id')->nullable();
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
            //
        });
    }
}
