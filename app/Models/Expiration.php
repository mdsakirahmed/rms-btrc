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
        'expire_date',
        'all_payment_completed'
    ];

    protected $dates = ['issue_date', 'expire_date'];


    public function operator(){
        return $this->belongsTo(Operator::class, 'operator_id', 'id');
    }

    public function expiration_wise_payment_dates(){
        return $this->hasMany(ExpirationWisePaymentDate::class, 'expiration_id', 'id');
    }

    public function total_due_amount(){
        $due = 0;
        foreach($this->expiration_wise_payment_dates as $period){
            $due += $period->total_due_amount();
        }
        return $due;
    }

    public function fee_type_wise_total_due_amount($fee_type_id){
        $due = 0;
        foreach($this->expiration_wise_payment_dates()->where('fee_type_id', $fee_type_id)->get() as $period){
            $due += $period->total_due_amount();
        }
        return $due;
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
                ->log('Create expiration');
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
                        ->log("Update expiration : $attr from {$model->getOriginal($attr)} to {$model->$attr}");
                }
            }
        });

        self::deleting(function ($model) {
            $model->expiration_wise_payment_dates()->delete(); // depended 1
        });

        self::deleted(function ($model) {
            activity()
                // ->causedBy($userModel)
                ->performedOn($model)
                ->useLog("delete")
                ->withProperties(['record' => $model])
                ->log('Delete expiration');
        });
    }
}
