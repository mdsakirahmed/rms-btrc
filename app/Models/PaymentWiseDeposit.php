<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class PaymentWiseDeposit extends Model
{
    use HasFactory, Userstamps;

    protected $guarded = [];

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
