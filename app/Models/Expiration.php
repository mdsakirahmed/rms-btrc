<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Expiration extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'operator_id',
        'starting_date',
        'ending_date',
        'total_price',
        'total_iteration'
    ];

    public function payments(){
        return $this->hasMany(Payment::class, 'expiration_id', 'id');
    }
}
