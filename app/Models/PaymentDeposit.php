<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class PaymentDeposit extends Model
{
    use HasFactory, Userstamps;
    
    protected $fillable = [
        'payment_id',
        'bank_id',
        'journal_number',
        'date',
    ];
}
