<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class FeeTypeWisePeriod extends Model
{
    use HasFactory, Userstamps;
    protected $guarded = [];

    public function fee_type(){
        return $this->belongsTo(FeeType::class, 'fee_type_id', 'id');
    }
}
