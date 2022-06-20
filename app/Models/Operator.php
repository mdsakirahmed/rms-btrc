<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Operator extends Model
{
    use HasFactory, Userstamps;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(LicenseCategory::class, 'category_id', 'id');
    }

    public function sub_category(){
        return $this->belongsTo(LicenseSubCategory::class, 'sub_category_id', 'id');
    }

    public function expirations(){
        return $this->hasMany(Expiration::class, 'operator_id', 'id');
    }

    public function payments(){
        return $this->hasMany(Payment::class, 'operator_id', 'id')->latest();
    }

    public function fee_type_wise_periods($fee_type_id){
        return $this->hasMany(Period::class, 'operator_id', 'id')->where('fee_type_id', $fee_type_id)->get();
    }

    public function late_fee_amount_by_fee_type($fee_type_id){
        $return_value = 0;
        foreach ($this->fee_type_wise_periods($fee_type_id) as $period){
            $return_value += round((((($period->total_receivable / 100) * $this->category->category_wise_fees()->where('fee_type_id', $fee_type_id)->first()->late_fee) ) / 365) * (abs(Carbon::now()->diffInDays($period->period_schedule_date, false))));
        }
        return $return_value;
    }

    public function vat_amount_by_fee_type($fee_type_id){
        $return_value = 0;
        foreach ($this->fee_type_wise_periods($fee_type_id) as $period){
            $return_value += round(($period->total_receivable / 100) * $this->category->category_wise_fees()->where('fee_type_id', $fee_type_id)->first()->vat);
        }
        return $return_value;
    }

    public function sum_of_receivable_vat_late_fee_amount_by_fee_type($fee_type_id){
        return $this->fee_type_wise_periods($fee_type_id)->sum('total_receivable') + $this->vat_amount_by_fee_type($fee_type_id) + $this->late_fee_amount_by_fee_type($fee_type_id);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here;
        });

        self::created(function ($model) {
            activity()
                // ->causedBy($userModel)
                ->performedOn($model)
                ->useLog("create")
                ->log('Create operator');
        });

        self::updating(function ($model) {
            // ... code here
        });

        self::updated(function ($model) {
            $changes = $model->isDirty() ? $model->getDirty() : false;
            if ($changes) {
                foreach ($changes as $attr => $value) {
                    activity()
                        // ->causedBy($user)
                        ->performedOn($model)
                        ->useLog("edit")
                        ->log("Update operator : $attr from {$model->getOriginal($attr)} to {$model->$attr}");
                }
            }
        });

        self::deleting(function ($model) {
            $model->expirations()->delete(); // depended 1
            $model->payments()->delete(); // depended 2
        });

        self::deleted(function ($model) {
            activity()
                // ->causedBy($userModel)
                ->performedOn($model)
                ->useLog("delete")
                ->withProperties(['record' => $model])
                ->log('Delete operator');
        });
    }

}
