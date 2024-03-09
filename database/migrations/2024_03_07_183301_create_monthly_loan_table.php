<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_loans', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('branch_id');
            $table->string('form_payment')->nullable();
            $table->string('loan_amount')->nullable();
            $table->string('interest')->nullable();
            $table->string('interest_percent')->nullable();
            $table->string('daily_payback')->nullable();
            $table->string('duration_in_days')->nullable();
            $table->string('amount_disburse')->nullable();
            $table->string('actual_profit')->default(0);
            $table->string('monthly_profit')->default(0);
            $table->string('yearly_profit')->default(0);
            $table->string('partial_pay')->default(0);
            $table->timestamp('disbursement_date')->nullable();
            $table->boolean('is_in_tenure')->default(0);
            $table->boolean('defaulted')->default(0);
            $table->string('purpose')->nullable();
            $table->string('admin_incharge')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_loans');
    }
}
