<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate(); //kosongkan table
        Role::create([
            'id' => 0,
            'name' => 'Admin',
            'alias' => 'admin',
        ]);
        Role::create([
            'id' => 1,
            'name' => 'Aplikan',
            'alias' => 'applicant',
        ]);
        Role::create([
            'id' => 2,
            'name' => 'admin unit',
            'alias' => 'unit',
        ]);
        Role::create([
            'id' => 3,
            'name' => 'Wakil Direktur 2',
            'alias' => 'wadir2',
        ]);
        Role::create([
            'id' => 4,
            'name' => 'Wakil Direktur 4',
            'alias' => 'wadir4',
        ]);
        Role::create([
            'id' => 5,
            'name' => 'Direktur',
            'alias' => 'direktur',
        ]);
    }
}
