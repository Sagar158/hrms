<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveApplication extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['user_id','leave_type_id','from','to','duration','reason','status','created_by','updated_by'];
    public const APPROVAL_PENDING_BY_HR = 0;
    public const APPROVED_BY_HR = 1;
    public const APPROVED_BY_HOD = 2;
    public const REJECTED_BY_HR = 3;
    public const REJECTED_BY_HOD = 4;
    public const STAGE_LABELS = [
        self::APPROVAL_PENDING_BY_HR => ['label' => 'Approval Pending By HR', 'bg-color' => 'bg-primary', 'message' => 'Your leave request has been submitted waiting for HR Approval','alert-type' => 'success'],
        self::APPROVED_BY_HR => ['label' => 'Approval Pending By HOD', 'bg-color' => 'bg-warning', 'message' => 'Approved by HR and waiting for HOD Approval','alert-type' => 'success'],
        self::APPROVED_BY_HOD => ['label' => 'Approved By HOD', 'bg-color' => 'bg-success', 'message' => 'Approved by HOD','alert-type' => 'success'],
        self::REJECTED_BY_HR => ['label' => 'Rejected By HR', 'bg-color' => 'bg-danger', 'message' => 'Rejected By HR','alert-type' => 'success'],
        self::REJECTED_BY_HOD => ['label' => 'Rejected By HOD', 'bg-color' => 'bg-danger', 'message' => 'Rejected By HOD','alert-type' => 'success'],
    ];


    public const NEXT_STAGE = [
        'employee' => [
            self::APPROVAL_PENDING_BY_HR => [
                0 => self::REJECTED_BY_HR,
                1 => self::APPROVED_BY_HR,
            ],
            self::APPROVED_BY_HR => [
                0 => self::REJECTED_BY_HOD,
                1 => self::APPROVED_BY_HOD,
            ],
            self::REJECTED_BY_HOD => [
                0 => self::REJECTED_BY_HR,
                1 => self::APPROVED_BY_HR
            ]
        ]
    ];

    public function applicationBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by','id');
    }
    public function leaveType()
    {
        return $this->hasOne(LeaveType::class,'id','leave_type_id');
    }

}
