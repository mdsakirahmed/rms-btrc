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
        'transaction',
    ];

    public function operator(){
        return $this->belongsTo(Operator::class, 'operator_id', 'id');
    }

    public function receives(){
        return $this->hasMany(PaymentWiseReceive::class, 'payment_id', 'id');
    }
    public function pay_orders(){
        return $this->hasMany(PaymentWisePayOrder::class, 'payment_id', 'id');
    }
    public function deposits(){
        return $this->hasMany(PaymentWiseDeposit::class, 'payment_id', 'id');
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
                ->log('Create payment');
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
                        ->log("Update payment : $attr from {$model->getOriginal($attr)} to {$model->$attr}");
                }
            }
        });

        self::deleting(function ($model) {
            $model->receives()->delete(); // depended 1
            $model->pay_orders()->delete(); // depended 2
            $model->deposits()->delete(); // depended 3
        });

        self::deleted(function ($model) {
            activity()
                // ->causedBy($userModel)
                ->performedOn($model)
                ->useLog("delete")
                ->withProperties(['record' => $model])
                ->log('Delete payment');
        });
    }
}
