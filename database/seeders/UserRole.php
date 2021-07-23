<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'id' => 1,
            'role' => 'Super Admin'
        ]);

        DB::table('user_roles')->insert([
            'id' => 100,
            'role' => 'Admin'
        ]);

        DB::table('user_roles')->insert([
            'id' => 101,
            'role' => 'Employe'
        ]);
    }
}
