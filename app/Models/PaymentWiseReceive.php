<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class PaymentWiseReceive extends Model
{
    use HasFactory, Userstamps;

    protected $guarded = [];

    public function period(){
        return $this->belongsTo(ExpirationWisePaymentDate::class, 'period_id', 'id');
    }
}
