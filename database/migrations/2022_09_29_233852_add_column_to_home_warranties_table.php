<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToHomeWarrantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_warranties', function (Blueprint $table) {
            //
            $table->string('sap_id','90');
            $table->text('sap_response');
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
            //
            Schema::dropIfExists('home_warranties');
        });
    }
}
