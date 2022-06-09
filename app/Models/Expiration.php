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
        'paid'
    ];

    protected $dates = ['issue_date', 'expire_date'];


    public function operator(){
        return $this->belongsTo(Operator::class, 'operator_id', 'id');
    }

    public function periods(){
        return $this->hasMany(Period::class, 'expiration_id', 'id');
    }

    public function payments(){
        return $this->hasMany(Payment::class, 'expiration_id', 'id');
    }

    public function total_due_amount(){
        $due = 0;
        foreach($this->periods as $period){
            $due += $period->total_due_amount();
        }
        return $due;
    }

    public function fee_type_wise_total_due_amount($fee_type_id){
        $due = 0;
        foreach($this->periods()->where('fee_type_id', $fee_type_id)->get() as $period){
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
            $model->periods()->delete(); // depended 1
            $model->payments()->delete(); // depended 2
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
