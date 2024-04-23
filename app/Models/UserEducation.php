<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEducation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'degree_title',
        'institute_name',
        'result',
        'passing_year'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createOrUpdate($educationId, $data)
    {
        // If id is provided, try to find the education entry by id
        if ($educationId != 0)
        {
            $userEducation = self::find($educationId);
            if (!$userEducation)
            {
                // If education entry with provided id does not exist, return null
                return null;
            }
            // If education entry exists, update it
            $userEducation->update($data);
            return $userEducation;
        }

        // If id is not provided, create a new education entry
        return self::create($data);
    }
}
