<?php

namespace App;

use App\Loan;
use App\Client;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];
    public function loan (){
        return $this->belongsTo(Loan::class,'loan_id');
    }
    public function client (){
        return $this->belongsTo(Client::class,'client_id');
    }
}
