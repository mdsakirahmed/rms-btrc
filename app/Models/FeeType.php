<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class FeeType extends Model
{
    use HasFactory, Userstamps;

    protected $guarded = [];

    public function periods(){
        return $this->hasMany(FeeTypeWisePeriod::class, 'fee_type_id', 'id');
    }

        // Auto delete depend data
        public static function boot() {
            parent::boot();
            static::deleting(function($model) { // this model
                $model->periods()->delete(); // depended 1
            });
        }
}
