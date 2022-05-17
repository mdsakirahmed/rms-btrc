<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ExpirationWisePaymentDate extends Model
{
    use HasFactory, Userstamps;
    protected $guarded = [];
    protected $dates = ['period_start_date', 'period_end_date', 'period_schedule_date'];

    public function fee_type(){
        return $this->belongsTo(FeeType::class, 'fee_type_id', 'id');
    }
    
}
