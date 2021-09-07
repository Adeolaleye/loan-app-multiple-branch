<?php

namespace App;

use App\Loan;
use App\Payment;
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
    ];
    public function loan (){
        return $this->hasMany(Loan::class,'client_id');
    }
    public function payment (){
        return $this->hasMany(Payment::class,'client_id');
    }
}
