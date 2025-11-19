<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['id' => 1, 'name' => 'Accounting'],
            ['id' => 2, 'name' => 'Business Development'],
            ['id' => 3, 'name' => 'Engineering'],
            ['id' => 4, 'name' => 'Human Resources'],
            ['id' => 5, 'name' => 'Legal'],
            ['id' => 6, 'name' => 'Marketing'],
            ['id' => 7, 'name' => 'Product Management'],
            ['id' => 8, 'name' => 'Sales'],
            ['id' => 9, 'name' => 'Training'],
        ];

        foreach ($departments as $dept) {
            DB::table('master_departemen')->insert([
                'id' => $dept['id'],
                'name' => $dept['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

