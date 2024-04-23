<?php
namespace App\Helpers;

use App\Models\Appointments;
use App\Models\User;
use App\Models\UserType;
use App\Models\HealthCare;
use App\Models\Products;
use App\Models\Specializations;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static $gender = array('male' => 'Male', 'female' => 'Female', 'other' => 'Other');
    public static $status = ['active' => 'Active', 'inactive' => 'Inactive'];
    public static $bloodGroup = ['a-' => 'A-','a+'=> 'A+','ab+' => 'Ab+','b-' => 'B-','b+' => 'B+','o-' => 'O-','o+' => 'O+'];
    public static $weekdays = array('monday' => 'Monday', 'tuesday' => 'Tuesday', 'wednesday' => 'Wednesday', 'thursday' => 'Thursday', 'friday' => 'Friday','saturday' => 'Saturday','sunday' => 'Sunday');

    public static function checkUserPermission($permissionName)
    {
        $permissions = self::userPermissions();
        return ($permissions->{$permissionName} == 1) ? true : false;
    }

    public static function userPermissions()
    {
        $userTypeId = auth()->user()->user_type_id;
        $permissions = UserType::select('permissions')->where('id', $userTypeId)->first()->permissions;

        return json_decode($permissions);
    }
    public static function fetchUserType()
    {
        return UserType::select('id','name')->pluck('name','id')->toArray();
    }

    public static function imageUpload($file, $existingFile = '')
    {
        $path = $file->store('public/uploads');
        return Storage::url($path);
    }

}
?>
