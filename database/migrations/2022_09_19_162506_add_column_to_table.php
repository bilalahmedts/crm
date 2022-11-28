<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('HRMSID')->default(0);
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->string('product_id')->default(0);
        });
        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('project_code')->default(0);
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
            $table->dropColumn('HRMSID');
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('product_id');
        });
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('project_code');
        });
    }
}
