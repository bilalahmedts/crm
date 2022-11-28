<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumn1ToRecordDssesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('record_dsses', function (Blueprint $table) {
            //
            $table->integer('dssdatafile_id')->after('campaign_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('record_dsses', function (Blueprint $table) {
            //
            Schema::dropIfExists('record_dsses');
        });
    }
}
