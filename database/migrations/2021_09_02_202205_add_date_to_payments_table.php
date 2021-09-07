<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('client_id')->nullable();
            $table->string('loan_id')->nullable();
            $table->string('next_due_date')->nullable();
            $table->string('outstanding_payment')->nullable();
            $table->string('bb_forward')->nullable();
            $table->string('expect_pay')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('date_paid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'client_id',
                'loan_id',
                'next_due_date',
                'outstanding_payment',
                'bb_forward',
                'expect_pay',
                'payment_status',
                'amount_paid',
                'date_paid',
            ]);
        });
    }
}
