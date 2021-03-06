<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'company_code' => rand(1, 999999),
            'name' => 'Admin',
            'username' => 'admin',
            'email' => null,
            'phone_number' => null,
            'password' => Hash::make('12345678'),
            'role_id' => '1',
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
