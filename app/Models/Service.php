<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $guarded = [];

    public function expenses(): HasMany{
        return $this->hasMany(Expense::class);
    }

    public function totalExpense(){
        if($this->expenses != null){
           $totalExpense = $this->expenses->sum('amount');;
           return $totalExpense;
        }
        return 0;
    }

    public function serviceTypes(){
        return $this->belongsToMany(ServiceType::class, 'pending_type')->withTimestamps();
     }
     public function depositBank()
    {
        return $this->belongsTo(DepositBank::class,'deposit_bank_id');
    }
    use HasFactory;
}
