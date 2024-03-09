<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_payments', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->nullable();
            $table->string('monthly_loan_id')->nullable();
            $table->string('branch_id')->nullable();
            $table->timestamp('next_due_date')->nullable();
            $table->string('outstanding_payment')->nullable();
            $table->string('bb_forward')->nullable();
            $table->string('expect_pay')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('amount_paid')->nullable();
            $table->timestamp('date_paid')->nullable();
            $table->string('payback_perday')->nullable();
            $table->string('partial_pay')->default(0);
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
        Schema::dropIfExists('monthly_payments');
    }
}
