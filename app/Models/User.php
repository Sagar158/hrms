<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public const SUPER_ADMIN = 1;
    public const ADMIN = 2;
    public const DIRECTOR = 3;
    public const HOD = 4;
    public const EMPLOYEE = 5;
    public const HR = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'date_of_birth',
        'contact_number',
        'address',
        'health_care_id',
        'age',
        'gender',
        'user_type_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'full_name'
    ];
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    public function usertype()
    {
        return $this->hasOne(UserType::class,'id','user_type_id');
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class,'user_id','id');
    }
    public function bank()
    {
        return $this->hasOne(UserBankAccount::class,'user_id','id');
    }

    public function education()
    {
        return $this->hasMany(UserEducation::class,'user_id','id');
    }


    public function documents()
    {
        return $this->hasMany(UserDocuments::class,'user_id','id');
    }

    public function designation(){
        return $this->hasOne(Designation::class,'id','designation_id');
    }
    public function department()
    {
        return $this->hasOne(Department::class,'id','department_id');
    }

}
