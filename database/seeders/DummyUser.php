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
            'name' => 'Teknologi Informasi',
            'email' => 'ti@unisayogya.ac.id',
            'password' => bcrypt("unisa"),
            'kdunit' => 41
        ]);
    }
}
