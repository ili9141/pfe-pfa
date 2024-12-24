<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $majors = [
            ['majorName' => 'Computer Science'],
            ['majorName' => 'Mechanical Engineering'],
            ['majorName' => 'Electrical Engineering'],
            ['majorName' => 'Civil Engineering'],
            ['majorName' => 'Mathematics'],
        ];

        foreach ($majors as $major) {
            Major::create($major);
        }
    }
}
