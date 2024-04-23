<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvanceSalary extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'branch_id','amount_requested'];


    public function branch()
    {
        return $this->hasOne(Branches::class,'id','branch_id');
    }

    public function employee(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
