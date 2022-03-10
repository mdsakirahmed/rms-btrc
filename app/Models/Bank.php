<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Bank extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'name'
    ];

    public function branches(){
        return $this->hasMany(Branch::class, 'bank_id', 'id');
    }
}
