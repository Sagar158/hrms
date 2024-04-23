<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
                    ['name' => 'Super Admin', 'permissions' => '{"users.view": "1","users.create": "1","users.edit": "1","users.delete": "1","permissions.view": "1","permissions.edit": "1","department.view" : "1","department.create" : "1","department.edit" : "1", "department.delete" : "1","designation.view" : "1", "designation.create" : "1","designation.edit" : "1", "designation.delete" : "1","holiday.view" : "1", "holiday.create" : "1","holiday.edit" : "1", "holiday.delete" : "1","leave_type.view" : "1", "leave_type.create" : "1","leave_type.edit" : "1", "leave_type.delete" : "1", "leave_application.view" : "1", "leave_application.create" : "1", "leave_application.edit" : "1", "leave_application.delete" : "1", "advance_salary.view" : "1", "advance_salary.create" : "1", "advance_salary.edit" : "1", "advance_salary.delete" : "1" }'],
                    ['name' => 'Admin', 'permissions' => '{"users.view": "1","users.create": "1","users.edit": "1","users.delete": "1","permissions.view": "1","permissions.edit": "1","department.view" : "1","department.create" : "1","department.edit" : "1", "department.delete" : "1","designation.view" : "1", "designation.create" : "1","designation.edit" : "1", "designation.delete" : "1","holiday.view" : "1", "holiday.create" : "1","holiday.edit" : "1", "holiday.delete" : "1","leave_type.view" : "1", "leave_type.create" : "1","leave_type.edit" : "1", "leave_type.delete" : "1", "leave_application.view" : "1", "leave_application.create" : "1", "leave_application.edit" : "1", "leave_application.delete" : "1", "advance_salary.view" : "1", "advance_salary.create" : "1", "advance_salary.edit" : "1", "advance_salary.delete" : "1" }'],
                    ['name' => 'Director', 'permissions' => '{"users.view": "1","users.create": "1","users.edit": "1","users.delete": "1","permissions.view": "1","permissions.edit": "1","department.view" : "1","department.create" : "1","department.edit" : "1", "department.delete" : "1","designation.view" : "1", "designation.create" : "1","designation.edit" : "1", "designation.delete" : "1","holiday.view" : "1", "holiday.create" : "1","holiday.edit" : "1", "holiday.delete" : "1","leave_type.view" : "1", "leave_type.create" : "1","leave_type.edit" : "1", "leave_type.delete" : "1", "leave_application.view" : "1", "leave_application.create" : "1", "leave_application.edit" : "1", "leave_application.delete" : "1", "advance_salary.view" : "1", "advance_salary.create" : "1", "advance_salary.edit" : "1", "advance_salary.delete" : "1" }'],
                    ['name' => 'HOD', 'permissions' => '{"users.view": "1","users.create": "1","users.edit": "1","users.delete": "1","permissions.view": "1","permissions.edit": "1","department.view" : "1","department.create" : "1","department.edit" : "1", "department.delete" : "1","designation.view" : "1", "designation.create" : "1","designation.edit" : "1", "designation.delete" : "1","holiday.view" : "1", "holiday.create" : "1","holiday.edit" : "1", "holiday.delete" : "1","leave_type.view" : "1", "leave_type.create" : "1","leave_type.edit" : "1", "leave_type.delete" : "1", "leave_application.view" : "1", "leave_application.create" : "1", "leave_application.edit" : "1", "leave_application.delete" : "1", "advance_salary.view" : "1", "advance_salary.create" : "1", "advance_salary.edit" : "1", "advance_salary.delete" : "1" }'],
                    ['name' => 'Employee', 'permissions' => '{"users.view": "1","users.create": "1","users.edit": "1","users.delete": "1","permissions.view": "1","permissions.edit": "1","department.view" : "1","department.create" : "1","department.edit" : "1", "department.delete" : "1","designation.view" : "1", "designation.create" : "1","designation.edit" : "1", "designation.delete" : "1","holiday.view" : "1", "holiday.create" : "1","holiday.edit" : "1", "holiday.delete" : "1","leave_type.view" : "1", "leave_type.create" : "1","leave_type.edit" : "1", "leave_type.delete" : "1", "leave_application.view" : "1", "leave_application.create" : "1", "leave_application.edit" : "1", "leave_application.delete" : "1", "advance_salary.view" : "1", "advance_salary.create" : "1", "advance_salary.edit" : "1", "advance_salary.delete" : "1" }'],
                ];

        UserType::truncate();
        if(!empty($data))
        {
            foreach($data as $value)
            {
                UserType::create($value);
            }
        }
    }
}
