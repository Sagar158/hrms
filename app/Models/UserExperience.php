<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserExperience extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id','company_name','position','address','working_duration'];

    public static function createOrUpdate($experienceId, $data)
    {
        // If id is provided, try to find the education entry by id
        if ($experienceId != 0)
        {
            $userExperience = self::find($experienceId);
            if (!$userExperience)
            {
                // If education entry with provided id does not exist, return null
                return null;
            }
            // If education entry exists, update it
            $userExperience->update($data);
            return $userExperience;
        }

        // If id is not provided, create a new education entry
        return self::create($data);
    }


}
