<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Application extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'name',
        'approved',
        'application_fee',
        'processing_fee'
    ];
}
