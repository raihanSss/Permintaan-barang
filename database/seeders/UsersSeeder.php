<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'purchasing',
                'email' => 'pur@gmail.com',
                'username' => 'purchasing',
                'password' => bcrypt('pur123'),
                'role' => 'purchasing'
            ],

            [
                'name' => 'ppic',
                'email' => 'ppic@gmail.com',
                'username' => 'ppic',
                'password' => bcrypt('ppic123'),
                'role' => 'ppic'
            ],

            [
                'name' => 'direktur',
                'email' => 'direktur@gmail.com',
                'username' => 'direktur',
                'password' => bcrypt('direktur123'),
                'role' => 'direktur'
            ],

            [
                'name' => 'supplier',
                'email' => 'supplier@gmail.com',
                'username'=> 'supplier',
                'password' => bcrypt('supp123'),
                'role' => 'supplier'
            ],

        ];

        foreach($user as $key => $value){
            User::create($value);
        }
    }
}
