<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'permanent_address',
        'permanent_city',
        'permanent_country',
        'present_address',
        'present_city',
        'present_country'
    ];

    public static function createOrUpdate($userId, $data)
    {
        $userAddress = self::where('user_id', $userId)->first();

        if ($userAddress)
        {
            $userAddress->update($data);
        }
        else
        {
            self::create(array_merge(['user_id' => $userId], $data));
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
