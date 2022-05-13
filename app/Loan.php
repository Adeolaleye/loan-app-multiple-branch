<?php

namespace App;

use App\Client;
use Illuminate\Database\Eloquent\Model;
class Loan extends Model
{
    protected $guarded = [];
    
    public function client (){
        return $this->belongsTo(Client::class);
    }
    public function payment (){
        return $this->hasMany(Payment::class);
    }
}
