<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToSaleMortgagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_mortgages', function (Blueprint $table) {
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
        Schema::table('sale_mortgages', function (Blueprint $table) {
            //
            Schema::dropIfExists('sale_mortgages');
        });
    }
}
