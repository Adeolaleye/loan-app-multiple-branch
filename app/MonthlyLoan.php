<?php

namespace App;

use App\MonthlyPayment;
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
    // public function monthlypayment()
    // {
    //     return $this->hasMany(MonthlyPayment::class);
    // }
    public function monthlyPayment()
    {
        return $this->hasMany(MonthlyPayment::class);
    }
}
