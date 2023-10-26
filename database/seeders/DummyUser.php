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
            'name' => 'unisa',
            'email' => 'unisa@yogya.ac.id',
            'password' => bcrypt(123456),
            'kdunit' => 100
        ]);
    }
}
