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
        'admin_incharge',
    ];
    public function loan (){
        return $this->hasMany(Loan::class,'client_id');
    }
    public function payment (){
        return $this->hasMany(Payment::class,'client_id');
    }
    // this is the recommended way for declaring event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($client) { // before delete() method call this
             $client->loan()->each(function($l) {
                $l->delete(); // <-- direct deletion
             });
             $client->payment()->each(function($p) {
                $p->delete(); // <-- raise another deleting event on Post to delete comments
             });
             // do the rest of the cleanup...
        });
    }
}
