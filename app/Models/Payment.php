<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Payment extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'operator_id',
        'transaction',
    ];

    public function operator(){
        return $this->belongsTo(Operator::class, 'operator_id', 'id');
    }

    public function receives(){
        return $this->hasMany(PaymentWiseReceive::class, 'payment_id', 'id');
    }
    public function pay_orders(){
        return $this->hasMany(PaymentWisePayOrder::class, 'payment_id', 'id');
    }
    public function deposits(){
        return $this->hasMany(PaymentWiseDeposit::class, 'payment_id', 'id');
    }

    // Auto delete depend data
    public static function boot() {
        parent::boot();
        static::deleting(function($invoice) { // this model
            $invoice->receives()->delete(); // depended 1
            $invoice->pay_orders()->delete(); // depended 2
            $invoice->deposits()->delete(); // depended 3
        });
    }
}
