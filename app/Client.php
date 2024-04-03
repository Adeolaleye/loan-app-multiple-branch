<?php

namespace App;

use App\Loan;
use App\Payment;
use App\MonthlyLoan;
use App\MonthlyPayment;
use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    protected $fillable = [
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
        'client_no',
        'admin_incharge',
        'branch_id'
    ];
    public function loan (){
        return $this->hasMany(Loan::class,'client_id');
    }
    public function monthlyloan (){
        return $this->hasMany(MonthlyLoan::class,'client_id');
    }
    public function payment (){
        return $this->hasMany(Payment::class,'client_id');
    }
    public function monthlypayment (){
        return $this->hasMany(MonthlyPayment::class,'client_id');
    }
}
