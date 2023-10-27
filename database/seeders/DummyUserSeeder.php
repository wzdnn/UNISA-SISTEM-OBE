<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    public function run(): void
    {
        $userData = [
            [
                'name'=>'Mas Admin',
                'email'=>'admin@gmail.com',
                'role'=>'superAdmin',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=>'Mas User',
                'email'=>'user@gmail.com',
                'role'=>'universitas',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=>'Mas Keuangan',
                'email'=>'user2@gmail.com',
                'role'=>'prodi',
                'password'=>bcrypt('123456')
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
