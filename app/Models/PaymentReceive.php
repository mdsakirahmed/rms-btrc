<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentReceive extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_category_id',
        'license_sub_category_id',
        'operator_id',
        'receivable_amount',
        'receive_date',
        'receive_amount',
        'receive_vat',
        'receive_let_fee',
    ];
}
