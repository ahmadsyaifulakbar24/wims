<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterParam extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'education',
            'name' => 'SD'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'education',
            'name' => 'SMP'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'education',
            'name' => 'SMA'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'education',
            'name' => 'DIPLOMA'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'education',
            'name' => 'S1'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'education',
            'name' => 'S2'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'education',
            'name' => 'S3'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'religion',
            'name' => 'Islam'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'religion',
            'name' => 'Katolik',
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'religion',
            'name' => 'Kristen'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'religion',
            'name' => 'Budhha'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'religion',
            'name' => 'Hindu'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'religion',
            'name' => 'Konghucu'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'marital_status',
            'name' => 'Single'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'marital_status',
            'name' => 'Married'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'marital_status',
            'name' => 'Widow'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'marital_status',
            'name' => 'Widower'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'blood_type',
            'name' => 'A'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'blood_type',
            'name' => 'B'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'blood_type',
            'name' => 'AB'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'blood_type',
            'name' => 'O'
        ]);
        
        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'employee_reach',
            'name' => '1-50'
        ]);
        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'employee_reach',
            'name' => '51-100'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'employee_reach',
            'name' => '101-300'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'employee_reach',
            'name' => '301-700'
        ]);

        DB::table('master_params')->insert([
            'parent_id' => null,
            'category' => 'employee_reach',
            'name' => '> 700'
        ]);
    }
}
