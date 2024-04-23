<?php

namespace Database\Seeders;

use App\Models\Branches;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Azikiwe'],
            ['name' => 'Kariakoo'],
            ['name' => 'Mwenge'],
            ['name' => 'Mikocheni'],
            ['name' => 'Mbezi'],
            ['name' => 'Arusha '],
            ['name' => 'Dodoma'],
        ];

        Branches::truncate();

        foreach($data as $value){
            Branches::create($value);
        }

    }
}
