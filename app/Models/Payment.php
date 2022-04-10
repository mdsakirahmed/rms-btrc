<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Payment extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'operator_id',
        'name',
    ];

    public function operator(){
        return $this->belongsTo(Operator::class, 'operator_id', 'id');
    }
}
