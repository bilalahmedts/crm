<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecordIdToHomeWarranties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_warranties', function (Blueprint $table) {
            $table->integer('record_id')->after('hrms_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_warranties', function (Blueprint $table) {
            Schema::dropIfExists('home_warranties');
        });
    }
}
