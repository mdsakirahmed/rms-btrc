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
        'receive_fee_id',
        'receive_period_id',
        'receivable_amount',
        'receive_date',
        'receive_amount',
        'receive_vat',
        'receive_let_fee',
    ];

    public function licenseCategory(){
        return $this->belongsTo(LicenseCategory::class, 'license_category_id');
    }

    public function licenseSubCategory(){
        return $this->belongsTo(LicenseSubCategory::class, 'license_sub_category_id');
    }

    public function operator(){
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function receiveFee(){
        return $this->belongsTo(ReceiveFee::class, 'receive_fee_id');
    }
    
    public function receivePeriod(){
        return $this->belongsTo(ReceivePeriod::class, 'receive_period_id');
    }

    




}
