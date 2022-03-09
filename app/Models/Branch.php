<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Branch extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'bank_id',
        'name',
        'routing_number',
    ];

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
