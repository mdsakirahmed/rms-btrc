<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class PaymentWiseReceive extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = ['payment_id','fee_type_id', 'period_date', 'receive_date', 'receive_amount', 'late_fee_percentage', 'vat_percentage', 'tax_percentage'];

    public function fee_type(){
        return $this->belongsTo(FeeType::class, 'fee_type_id', 'id');
    }
}
