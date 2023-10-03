<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = [
            [
                'kode_barang' => 'NKR 71 Cc - 30 Gr',
                'nama_barang' => 'Weight Balance',
                'quantity' => '150',
            ],
            [
                'kode_barang' => 'NKR 71 Cc - 40 Gr',
                'nama_barang' => 'Weight Balance',
                'quantity' => '150',
            ],
            [
                'kode_barang' => 'NKR 71 Cc - 50 Gr',
                'nama_barang' => 'Weight Balance',
                'quantity' => '150',
            ],
            [
                'kode_barang' => 'NKR 71 Cc - 60 Gr',
                'nama_barang' => 'Weight Balance',
                'quantity' => '150',
            ],
            [
                'kode_barang' => 'NKR 55 Cc - 30 Gr',
                'nama_barang' => 'Weight Balance',
                'quantity' => '150',
            ],
            [
                'kode_barang' => 'NKR 55 Cc - 40 Gr',
                'nama_barang' => 'Weight Balance',
                'quantity' => '150',
            ],
            [
                'kode_barang' => 'NKR 55 Cc - 50 Gr',
                'nama_barang' => 'Weight Balance',
                'quantity' => '150',
            ],
            [
                'kode_barang' => 'NKR 55 Cc - 60 Gr',
                'nama_barang' => 'Weight Balance',
                'quantity' => '150',
            ],

            
        ];

        foreach($barang as $key => $value){
            Barang::create($value);
        }
    }
}
