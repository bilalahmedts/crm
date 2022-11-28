<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameProjectIdAndClientID extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function(Blueprint $table) {
            $table->renameColumn('product_id', 'client_code');
        });
        Schema::table('projects', function(Blueprint $table) {
            $table->renameColumn('project_id', 'project_code');
        });
        Schema::table('sale_records', function(Blueprint $table) {
            $table->renameColumn('agent_id', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
