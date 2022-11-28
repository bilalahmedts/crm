<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnsToSaleRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_records', function (Blueprint $table) {
            //
            $table->enum('qa_status',['billable','not-billable','unsuccessfull-transfer','pending'])->default('pending')->after('status');
            $table->enum('client_status',['billable','not-billable','unsuccessfull-transfer','pending'])->default('pending')->after('qa_status');
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
            //
            Schema::dropIfExists('sale_records');
        });
    }
}
