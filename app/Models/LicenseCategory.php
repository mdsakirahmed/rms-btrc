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
        'license_fee',
        'duration_year',
        'duration_month',
        'payment_iteration',
    ];
}
