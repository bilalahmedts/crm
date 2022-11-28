<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeWarrantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_warranties', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('notes')->nullable();
            $table->enum('client',['D1','D2','D3','D4','GHW','HW CH','HW CH less than 58','HW CH 50 Years'])->nullable();
            $table->text('post_data')->nullable();
            $table->text('post_response')->nullable();
            $table->integer('hrms_id')->nullable();
            $table->enum('status',['Accepted','Rejected','Unsuccessful Transfer','Pending'])->default('Pending');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('home_warranties');
    }
}
