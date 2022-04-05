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
        'issue_date',
        'expire_date'
    ];

    protected $dates = ['issue_date', 'expire_date'];

    public function payments(){
        return $this->hasMany(Payment::class, 'expiration_id', 'id');
    }

    public function operator(){
        return $this->belongsTo(Operator::class, 'operator_id', 'id');
    }
}
