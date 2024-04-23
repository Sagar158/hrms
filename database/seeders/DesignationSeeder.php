<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Vice Chairman'],
            ['name' => 'Chief Executive Officer (CEO)'],
            ['name' => 'Chief Finance & Admin Officer'],
            ['name' => 'Sr. Finance & Admin Officer - I'],
            ['name' => 'Jr. Finance & Admin Officer'],
            ['name' => 'Senior Research Associate-1'],
            ['name' => 'Research Associate-1'],
            ['name' => 'Junior Research Associate'],
            ['name' => 'Research Assistant'],
            ['name' => 'Sr. Office Assistant'],
            ['name' => 'Office Assistant'],
            ['name' => 'IT Analyst'],
            ['name' => 'Cook'],
            ['name' => 'Software Engineer'],
            ['name' => 'System Analyst'],
            ['name' => 'Programmer Analyst'],
            ['name' => 'Sr Software Engineer'],
            ['name' => 'Technical Specialist'],
            ['name' => 'Trainee Engineer'],
            ['name' => 'Intern'],
            ['name' => 'Head of Department'],
            ['name' => 'Business Analyst'],
            ['name' => 'Web Developer'],
            ['name' => 'Big Data Engineer'],
            ['name' => 'Project Manager'],
            ['name' => 'Trainee'],
        ];

        Designation::truncate();
        foreach($data as $value)
        {
            Designation::create($value);
        }
    }
}
