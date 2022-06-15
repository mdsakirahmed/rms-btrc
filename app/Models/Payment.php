<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Payment extends Model
{
    use HasFactory, Userstamps;

    protected $guarded = [];

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'operator_id', 'id');
    }

    public function depositor()
    {
        return $this->belongsTo(User::class, 'deposit_by_user_id', 'id');
    }

    public function receives()
    {
        return $this->hasMany(PaymentWiseReceive::class, 'payment_id', 'id');
    }

    public function pay_orders()
    {
        return $this->hasMany(PaymentWisePayOrder::class, 'payment_id', 'id');
    }

    public function deposits()
    {
        return $this->hasMany(PaymentWiseDeposit::class, 'payment_id', 'id');
    }

    // Receives
    public function total_receive_amount()
    {
        return $this->receives()->sum('receive_amount');
    }

    public function total_receive_spectrum_amount()
    {
        $return_value = 0;
        foreach ($this->receives as $value) {
            if($value->period->fee_type_id == 3)
            $return_value += $value->receive_amount;
        }
        return $return_value;
    }

    public function total_receive_spectrum_vat_amount()
    {
        $return_value = 0;
        foreach ($this->receives as $value) {
            if($value->period->fee_type_id == 3)
            $return_value += ($value->vat_percentage / 100) * $value->receive_amount;
        }
        return $return_value;
    }

    public function total_receive_vat_amount()
    {
        $return_value = 0;
        foreach ($this->receives as $value) {
            $return_value += ($value->vat_percentage / 100) * $value->receive_amount;
        }
        return $return_value;
    }

    public function total_receive_tax_amount()
    {
        $return_value = 0;
        foreach ($this->receives as $value) {
            $return_value += ($value->tax_percentage / 100) * $value->receive_amount;
        }
        return $return_value;
    }

    public function total_receive_late_fee_amount()
    {
        return $this->receives()->sum('late_fee_receive_amount');
    }

    public function receive_years_as_string()
    {
        $return_value = "";
        foreach ($this->receives()->pluck('receive_date') as $key => $value) {
            if ($key != count($this->receives()->pluck('receive_date')) - 1) {
                $return_value = $return_value . ' ' . date('Y', strtotime($value)) . ',';
            } else {
                $return_value = $return_value . ' ' . date('Y', strtotime($value));
            }
        }
        return  $return_value;
    }

    public function receive_dates_as_string()
    {
        $return_value = "";
        foreach ($this->receives()->pluck('receive_date') as $key => $value) {
            if ($key != count($this->receives()->pluck('receive_date')) - 1) {
                $return_value = $return_value . ' ' . date('d-m-Y', strtotime($value)) . ',';
            } else {
                $return_value = $return_value . ' ' . date('d-m-Y', strtotime($value));
            }
        }
        return  $return_value;
    }

    public function receive_schedule_dates_as_string()
    {
        $return_value = "";
        foreach ($this->receives as $key => $value) {
            if ($key != $this->receives()->count() - 1) {
                $return_value = $return_value . ' ' . date('d-m-Y', strtotime($value->period->period_schedule_date)) . ',';
            } else {
                $return_value = $return_value . ' ' . date('d-m-Y', strtotime($value->period->period_schedule_date));
            }
        }
        return  $return_value;
    }

    // Pay Order
    public function po_numbers_as_string()
    {
        $return_value = "";
        foreach ($this->pay_orders()->pluck('number') as $key => $value) {
            if ($key != count($this->pay_orders()->pluck('number')) - 1) {
                $return_value = $return_value . ' ' . $value . ',';
            } else {
                $return_value = $return_value . ' ' . $value;
            }
        }
        return  $return_value;
    }

    public function po_dates_as_string()
    {
        $return_value = "";
        foreach ($this->pay_orders()->pluck('date') as $key => $value) {
            if ($key != count($this->pay_orders()->pluck('number')) - 1) {
                $return_value = $return_value . ' ' . date('d/m/y', strtotime($value)) . ',';
            } else {
                $return_value = $return_value . ' ' . date('d/m/y', strtotime($value));
            }
        }
        return  $return_value;
    }
    public function po_banks_as_string()
    {
        $return_value = "";
        foreach ($this->pay_orders()->pluck('bank_id') as $key => $value) {
            if ($key != count($this->pay_orders()->pluck('number')) - 1) {
                $return_value = $return_value . ' ' . (Bank::find($value)->name ?? 'Bank not found') . ',';
            } else {
                $return_value = $return_value . ' ' . (Bank::find($value)->name ?? 'Bank not found');
            }
        }
        return  $return_value;
    }
    public function total_po_amount()
    {
        return $this->pay_orders()->sum('amount');
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
