<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class PaymentWiseReceive extends Model
{
    use HasFactory, Userstamps, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['receive_date'];
    
    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function period(){
        return $this->belongsTo(Period::class, 'period_id', 'id');
    }

    public function total(){
        return round($this->receive_amount +  $this->late_fee_receive_amount + (($this->vat_percentage/100) * $this->receive_amount) + (($this->tax_percentage/100) * $this->receive_amount));
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here;
        });

        self::created(function ($model) {
//            if($model->period->total_due_amount() <= 0){
//                $model->period()->update(['paid', true]);
//                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => ' *** PAID *** ']);
//            }
            activity()
                // ->causedBy($userModel)
                ->performedOn($model)
                ->useLog("create")
                ->log('Create collection');
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
                        ->log("Update collection : $attr from {$model->getOriginal($attr)} to {$model->$attr}");
                }
            }
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            activity()
                // ->causedBy($userModel)
                ->performedOn($model)
                ->useLog("delete")
                ->withProperties(['record' => $model])
                ->log('Delete collection');
        });
    }
}
