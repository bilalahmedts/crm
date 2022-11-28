<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateV11 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // knowledge category default img nullable and null
        Schema::table('kb_categories', function($table) {
            $table->string('img')->nullable()->default(null)->change();
        });
        
        // ticket user id set to nullable default null
        Schema::table('tickets', function($table) {
            // $table->dropForeign('tickets_user_id_foreign');
            $table->unsignedBigInteger('user_id')->nullable()->default(null)->change();
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
