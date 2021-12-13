<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class License extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'license_sub_category_id',
        'license_category_id',
        'license_number',
        'name',
        'email',
        'phone',
        'address',
        'fee',
        'instalment',
    ];
}
