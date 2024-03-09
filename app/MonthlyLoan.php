<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthlyLoan extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'monthly_loans';

    protected $guarded = [];
    
    public function client (){
        return $this->belongsTo(Client::class);
    }
    // public function payment (){
    //     return $this->hasMany(Payment::class);
    // }
}
