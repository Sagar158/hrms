<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveApplicationDetails extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['leave_application_id','status','details','created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
