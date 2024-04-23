<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Administration'],
            ['name' => 'Finance, HR, & Admininstration'],
            ['name' => 'Research'],
            ['name' => 'Information Technology'],
            ['name' => 'Support'],
            ['name' => 'Network Engineering'],
            ['name' => 'Sales and Marketing'],
            ['name' => 'Helpdesk'],
            ['name' => 'Project Management'],
        ];
        Department::truncate();
        foreach($data as $value)
        {
            Department::create($value);
        }
    }
}
