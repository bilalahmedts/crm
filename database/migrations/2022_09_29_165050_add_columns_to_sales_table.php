<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_records', function (Blueprint $table) {
            $table->integer('agent_revnue')->after('client_status')->default(0);
            $table->integer('client_billed')->after('agent_revnue')->default(0);
            $table->integer('action_by_director')->after('client_billed')->default(0);
        });
        Schema::table('sale_mortgages', function (Blueprint $table) {
            $table->integer('agent_revnue')->after('client_status')->default(0);
            $table->integer('client_billed')->after('agent_revnue')->default(0);
            $table->integer('action_by_director')->after('client_billed')->default(0);
        });
        Schema::table('home_warranties', function (Blueprint $table) {
            $table->integer('agent_revnue')->default(0);
            $table->integer('client_billed')->default(0);
            $table->integer('action_by_director')->default(0);
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
            Schema::dropIfExists('agent_revnue');
            Schema::dropIfExists('client_billed');
            Schema::dropIfExists('action_by_director');
        });
        Schema::table('sale_mortgages', function (Blueprint $table) {
            Schema::dropIfExists('agent_revnue');
            Schema::dropIfExists('client_billed');
            Schema::dropIfExists('action_by_director');
        });
        Schema::table('home_warranties', function (Blueprint $table) {
            Schema::dropIfExists('agent_revnue');
            Schema::dropIfExists('client_billed');
            Schema::dropIfExists('action_by_director');
        });
    }
}
