<?php

namespace Database\Seeders;

use App\Models\Officer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $officers = [
            'Aldi Nasution',
            'Mara Sonang Siregar',
            'Erik Kusuma',
            'Abdi Enggan Siregar',
            'M.Yani Esa',
            'Arman Sinaloan Siregar',
            'Rizal Siregar',
            'Saipul Anwar Harahap',
            'Pangiutan Siregar',
            'Alwi Wahyu H.Nst',
            'Drajat Harahap',
            'Berton Nasuion',
            'Hikler Lubis',
            'Ansari Saputra Siregar',
            'Parhimpunan'
        ];

        foreach ($officers as $officer)
            Officer::create([
                'name' => $officer,
                'address' => 'Kota Padangsidimpuan',
                'status' => 'Active'
            ]);
    }
}
