<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkFromHomeAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_from_home_attendences', function (Blueprint $table) {
            $table->id();
            $table->integer('HRMSID')->default(0); 
            $table->timestamp('Att_Date');
            $table->enum('Att_timeIn_timeOut',[0,1,2])->default(0);
            $table->softDeletes();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_from_home_attendences');
    }
}
