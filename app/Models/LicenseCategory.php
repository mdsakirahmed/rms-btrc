<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class LicenseCategory extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'name',
        'duration_year',
        'duration_month',
    ];

    public function category_wise_fees(){
        return $this->hasMany(LicenseCategoryWiseFeeType::class, 'category_id', 'id');
    }
}
