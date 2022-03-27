<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Operator extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'name',
        'category_id',
        'sub_category_id',
    ];

    public function category(){
        return $this->belongsTo(LicenseCategory::class, 'category_id', 'id');
    }

    public function sub_category(){
        return $this->belongsTo(LicenseSubCategory::class, 'sub_category_id', 'id');
    }

    public function expirations(){
        return $this->hasMany(Expiration::class, 'operator_id', 'id');
    }
}
