<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Period extends Model
{
    use HasFactory, Userstamps, SoftDeletes;
    protected $guarded = [];
    protected $dates = ['period_start_date', 'period_end_date', 'period_schedule_date'];

    public function fee_type(){
        return $this->belongsTo(FeeType::class, 'fee_type_id', 'id');
    }

    public function expiration(){
        return $this->belongsTo(Expiration::class, 'expiration_id', 'id');
    }

    public function payment_receives(){
        return $this->hasMany(PaymentWiseReceive::class, 'period_id', 'id');
    }

    public function total_paid_amount(){
        return $this->payment_receives->sum('receive_amount');
    }

    public function total_due_amount(){
        return ($this->total_receivable - $this->total_paid_amount());
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
                ->log('Create period');
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
                        ->log("Update period : $attr from {$model->getOriginal($attr)} to {$model->$attr}");
                }
            }
        });

        self::deleting(function ($model) {
            $model->payment_receives()->delete();
        });

        self::deleted(function ($model) {
            activity()
                // ->causedBy($userModel)
                ->performedOn($model)
                ->useLog("delete")
                ->withProperties(['record' => $model])
                ->log('Delete period');
        });
    }
}
