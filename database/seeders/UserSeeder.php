<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'employee_code' => '100',
                'department_id' => '1',
                'designation_id' => '1',
                'user_type_id' => 1,
                'gender' => 'male',
                'blood_group' => 'b+',
                'nid' => '1234567890',
                'contact_number' => '03351257417',
                'date_of_birth' => '1996-07-05',
                'date_of_joining' => '2019-01-10',
                'username' => 'superadmin',
                'email' => 'superadmin@hrms.co',
                'password' => Hash::make('1234567890'),
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'employee_code' => '101',
                'department_id' => '1',
                'designation_id' => '1',
                'user_type_id' => 2,
                'gender' => 'male',
                'blood_group' => 'b+',
                'nid' => '1234567890',
                'contact_number' => '03351257418',
                'date_of_birth' => '1996-07-05',
                'date_of_joining' => '2019-01-10',
                'username' => 'admin',
                'email' => 'admin@hrms.co',
                'password' => Hash::make('1234567890'),
            ],
            [
                'first_name' => 'Director',
                'last_name' => 'Director',
                'employee_code' => '102',
                'department_id' => '1',
                'designation_id' => '1',
                'user_type_id' => 2,
                'gender' => 'male',
                'blood_group' => 'b+',
                'nid' => '1234567890',
                'contact_number' => '03351257418',
                'date_of_birth' => '1996-07-05',
                'date_of_joining' => '2019-01-10',
                'username' => 'director',
                'email' => 'director@hrms.co',
                'password' => Hash::make('1234567890'),
            ],
            [
                'first_name' => 'HOD',
                'last_name' => 'HOD',
                'employee_code' => '103',
                'department_id' => '1',
                'designation_id' => '1',
                'user_type_id' => 2,
                'gender' => 'male',
                'blood_group' => 'b+',
                'nid' => '1234567890',
                'contact_number' => '03351257418',
                'date_of_birth' => '1996-07-05',
                'date_of_joining' => '2019-01-10',
                'username' => 'hod',
                'email' => 'hod@hrms.co',
                'password' => Hash::make('1234567890'),
            ],
            [
                'first_name' => 'Employee',
                'last_name' => 'Employee',
                'employee_code' => '104',
                'department_id' => '1',
                'designation_id' => '1',
                'user_type_id' => 2,
                'gender' => 'male',
                'blood_group' => 'b+',
                'nid' => '1234567890',
                'contact_number' => '03351257418',
                'date_of_birth' => '1996-07-05',
                'date_of_joining' => '2019-01-10',
                'username' => 'employee',
                'email' => 'employee@hrms.co',
                'password' => Hash::make('1234567890'),
            ],

        ];

        User::truncate();
        if(!empty($data))
        {
            foreach($data as $value){
                User::create($value);
            }
        }
    }
}
