<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class LicenseCategoryWiseFeeType extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'category_id',
        'fee_type_id',
        'iteration',
        'amount',
        'late_fee',
        'vat',
        'tax',

    ];

    public function category(){
        return $this->belongsTo(LicenseCategory::class, 'category_id', 'id');
    }

    public function fee_type(){
        return $this->belongsTo(FeeType::class, 'fee_type_id', 'id');
    }
}
