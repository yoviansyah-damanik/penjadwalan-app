<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Yoviansyah Rizki Pratama',
            'email' => 'yoviansyahrizkypratama@gmail.com',
            'username' => 'yoviansyah25',
            'password' => bcrypt('12345678')
        ]);
    }
}
