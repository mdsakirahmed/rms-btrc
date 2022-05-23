<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Expiration extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'operator_id',
        'issue_date',
        'expire_date',
        'all_payment_completed'
    ];

    protected $dates = ['issue_date', 'expire_date'];


    public function operator(){
        return $this->belongsTo(Operator::class, 'operator_id', 'id');
    }

    public function expiration_wise_payment_dates(){
        return $this->hasMany(ExpirationWisePaymentDate::class, 'expiration_id', 'id');
    }

    public function total_due_amount(){
        $due = 0;
        foreach($this->expiration_wise_payment_dates as $period){
            $due += $period->total_due_amount();
        }
        return $due;
    }

    public function fee_type_wise_total_due_amount($fee_type_id){
        $due = 0;
        foreach($this->expiration_wise_payment_dates()->where('fee_type_id', $fee_type_id)->get() as $period){
            $due += $period->total_due_amount();
        }
        return $due;
    }

    // Auto delete depend data
    public static function boot() {
        parent::boot();
        static::deleting(function($model) { // this model
            $model->expiration_wise_payment_dates()->delete(); // depended 1
        });
    }
}
