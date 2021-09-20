<?php

namespace App;

use App\Client;
use Illuminate\Database\Eloquent\Model;
class Loan extends Model
{
    protected $guarded = [];
    protected $fillable = [
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
               'monthly_payback',
               'expected_profit',
               'actual_profit',
               'purpose',
                'admin_incharge',
                'admin_who_disburse',
                'sum_of_allpayback',
                'formpayment',
                'intrest_percent',
    ];
    public function client (){
        return $this->belongsTo(Client::class);
    }
    public function payment (){
        return $this->hasMany(Payment::class);
    }
}
