<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class License extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'user_id',
        'license_sub_category_id',
        'license_category_id',
        'license_number',
        'fee',
        'instalment',
        'expire_date',
    ];

    //Relational function
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function payments(){
        return $this->hasMany(Payment::class, 'license_id', 'id');
    }
}
