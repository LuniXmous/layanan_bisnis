<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // dd(Str::uuid(),  Str::uuid(), Str::uuid(), Str::uuid());
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            UnitSeeder::class,
            ChangeRoleNameSeeder::class,
        ]);
    }
}
