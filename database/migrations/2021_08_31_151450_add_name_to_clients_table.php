<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('occupation')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('office_address')->nullable();
            $table->string('means_of_id')->nullable();
            $table->string('qualification')->nullable();
            $table->string('g_name')->nullable();
            $table->string('g_phone')->nullable();
            $table->string('g_address')->nullable();
            $table->string('g_relationship')->nullable();
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
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'phone',
                'dob',
                'gender',
                'marital_status',
                'profile_picture',
                'occupation',
                'residential_address',
                'office_address',
                'means_of_id',
                'qualification',
                'g_name',
                'g_phone',
                'g_address',
                'g_relationship',
                'status',
            ]);
        });
    }
}
