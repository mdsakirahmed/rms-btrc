<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;
class Product extends Model
{
    use HasFactory, Userstamps;

    protected $fillable =[
        'name',
        'price',
        'quantity'
    ];
}
