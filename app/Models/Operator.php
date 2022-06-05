<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Operator extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'name',
        'phone',
        'email',
        'website',
        'address',
        'note',
        'contact_person_name',
        'contact_person_designation',
        'contact_person_phone',
        'contact_person_email',
    ];

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
