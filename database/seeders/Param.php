<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Param extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('params')->insert([
            'category' => 'organization_structure',
            'param' => 'directure',
        ]);

        DB::table('params')->insert([
            'category' => 'job_level',
            'param' => 'IT Departement',
        ]);

        DB::table('params')->insert([
            'category' => 'job_position',
            'param' => 'directure1',
        ]);

        DB::table('params')->insert([
            'category' => 'employee_status',
            'param' => 'sip malam',
        ]);
        
    }
}
