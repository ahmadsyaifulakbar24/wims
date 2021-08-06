<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PtkpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ptkp = DB::table('ptkp');

        $ptkp->insert([
            'id' => 1,
            'ptkp' => 'Tidak Kawin/TK0',
            'rate' => 54000000,
            'description' => 'Wajib Pajak Tidak Kawin Tanpa Tanggungan'
        ]);

        $ptkp->insert([
            'id' => 2,
            'ptkp' => 'Tidak Kawin/TK1',
            'rate' => 58500000,
            'description' => 'Wajib Pajak Tidak Kawin dengan 1 (Satu) Tanggungan'
        ]);

        $ptkp->insert([
            'id' => 3,
            'ptkp' => 'Tidak Kawin/TK2',
            'rate' => 63000000,
            'description' => 'Wajib Pajak Tidak Kawin dengan 2 (Dua) Tanggungan'
        ]);

        $ptkp->insert([
            'id' => 4,
            'ptkp' => 'Tidak Kawin/TK3',
            'rate' => 67500000,
            'description' => 'Wajib Pajak Tidak Kawin dengan 3 (Tiga) Tanggungan'
        ]);

        $ptkp->insert([
            'id' => 5,
            'ptkp' => 'Kawin/K0',
            'rate' => 58500000,
            'description' => 'Wajib Pajak Kawin Tanpa Tanggungan'
        ]);

        $ptkp->insert([
            'id' => 6,
            'ptkp' => 'Kawin/K1',
            'rate' => 63000000,
            'description' => 'Wajib Pajak Kawin dengan 1 (Satu) Tanggungan'
        ]);

        $ptkp->insert([
            'id' => 7,
            'ptkp' => 'Kawin/K2',
            'rate' => 67500000,
            'description' => 'Wajib Pajak Kawin dengan 2 (Dua) Tanggungan'
        ]);

        $ptkp->insert([
            'id' => 8,
            'ptkp' => 'Kawin/K3',
            'rate' => 72000000,
            'description' => 'Wajib Pajak Kawin dengan 3 (Tiga) Tanggungan'
        ]);

        $ptkp->insert([
            'id' => 9,
            'ptkp' => 'Kawin/K/I/0',
            'rate' => 112500000,
            'description' => 'Wajib Pajak Kawin dan Penghasilan Istri Digabung dengan Penghasilan Suami'
        ]);

        $ptkp->insert([
            'id' => 10,
            'ptkp' => 'Kawin/K/I/1',
            'rate' => 117000000,
            'description' => 'Wajib Pajak Kawin dan Penghasilan Istri Digabung dengan Penghasilan Suami dengan 1 (Satu) Tanggungan'
        ]);

        $ptkp->insert([
            'id' => 11,
            'ptkp' => 'Kawin/K/I/2',
            'rate' => 121500000,
            'description' => 'Wajib Pajak Kawin dan Penghasilan Istri Digabung dengan Penghasilan Suami dengan 2 (Dua) Tanggungan'
        ]);

        $ptkp->insert([
            'id' => 12,
            'ptkp' => 'Kawin/K/I/3',
            'rate' => 126000000,
            'description' => 'Wajib Pajak Kawin dan Penghasilan Istri Digabung dengan Penghasilan Suami dengan 3 (Tiga) Tanggungan'
        ]);
    }
}
