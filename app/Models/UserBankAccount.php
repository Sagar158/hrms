<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBankAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id','bank_holder_name','bank_name','branch_name','bank_account_number','bank_account_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createOrUpdate($userId, $data)
    {
        $userBankAccount = self::where('user_id', $userId)->first();

        if ($userBankAccount)
        {
            $userBankAccount->update($data);
        }
        else
        {
            self::create($data);
        }
    }


}
