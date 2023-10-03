<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'nama_supplier' => 'PT Gawa Raya Sentosa',
                'alamat_supplier' => 'JL. KH. Hasyim Ashari Kav ,DPR Block C No 99 Rt 006 Rw 002 Tangerang 15144',
                'no_telp_supplier' => '085619255466',
            ],
        ];

        foreach($suppliers as $key => $value){
            Supplier::create($value);
        }
    }
}
