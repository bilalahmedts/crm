<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleMortgagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_mortgages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('client_id');
            $table->integer('record_id');
            $table->integer('campaign_id');
            $table->string('first_name','70');
            $table->string('last_name','70');
            $table->string('address','200');
            $table->string('city','50');
            $table->string('state','20');
            $table->string('zipcode','8');
            $table->bigInteger('phone');
            $table->string('email')->nullable();
            $table->float('age', 8,2)->nullable();
            $table->string('loan_type')->nullable();
            $table->string('purpose_of_loan')->nullable();
            $table->string('mortgage_balance')->nullable();
            $table->string('interest_rate')->nullable();
            $table->string('credit_score','60')->nullable();
            $table->string('credit_rating','60')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('house_value')->nullable();
            $table->string('best_timing')->nullable();
            $table->string('cash_amount')->nullable();
            $table->string('current_amount')->nullable();
            $table->string('current_rate')->nullable();
            $table->string('property_type','40')->nullable();
            $table->string('property_value')->nullable();
            $table->string('income','50')->nullable();
            $table->string('dob','50')->nullable();
            $table->string('notes')->nullable();
            $table->string('monthly_payment')->nullable();
            $table->string('late_payment')->nullable(); 
            $table->string('ltv')->nullable();
            $table->string('cash_out')->nullable();
            $table->string('loan_amount')->nullable();
            $table->string('rate_type')->nullable();
            $table->string('transfer_by')->nullable();
            $table->string('call_transfer_status')->nullable();
            $table->string('loanofficername')->nullable();             
			$table->string('bankrupty')->nullable(); 
            $table->string('employment')->nullable(); 

            $table->enum('status',['Active','Disable']);
            $table->integer('user_id')->default(0);
            $table->string('company')->nullable();
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
        Schema::dropIfExists('sale_mortgages');
    }
}
