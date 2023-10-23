<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'nama user TI',
            'email' => 'ti@gmail.com',
            'password' => bcrypt(123456),
            'kdunit' => 41
        ]);
    }
}
