<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate(); //kosongkan table
        User::create([
            'id' => "5ac8d461-cd11-49fd-97bd-bbc9ba62a362",
            'name' => "admin",
            'email' => "admin@gmail.com",
            'role_id' => 0,
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make("admin123"),
        ]);
        User::create([
            'id' => "54846a7c-8f1b-4bb6-b503-b36cefe129c8",
            'name' => "applikan",
            'email' => "applikan@gmail.com",
            'role_id' => 1,
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make("pengguna123"),
        ]);
    }
}
