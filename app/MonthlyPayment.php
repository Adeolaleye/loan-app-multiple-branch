<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthlyPayment extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'monthly_payments';

    protected $guarded = [];
    
    public function monthlyloan (){
        return $this->belongsTo(Loan::class,'loan_id');
    }
    public function client (){
        return $this->belongsTo(Client::class,'client_id');
    }
}
