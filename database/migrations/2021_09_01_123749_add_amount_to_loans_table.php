<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmountToLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->string('client_id')->nullable();
            $table->string('loan_amount')->nullable();
            $table->string('intrest')->nullable();
            $table->string('total_payback')->nullable();
            $table->string('fp_amount')->nullable();
            $table->string('fp_status')->nullable();
            $table->string('disbursement_date')->nullable();
            $table->string('tenure')->nullable();
            $table->string('loan_duration')->nullable();
            $table->string('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn([
               'client_id',
               'loan_amount',
               'intrest',
               'total_payback',
               'fp_amount',
               'fp_status',
               'disbursement_date',
               'tenure',
               'loan_duration',
               'status',
            ]);
        });
    }
}
