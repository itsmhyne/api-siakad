<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassRoom;
use App\Models\Student;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Data Kelas Dulu
        $kelas1 = ClassRoom::create(['level' => 10, 'name' => 'X-TKR']);
        $kelas2 = ClassRoom::create(['level' => 10, 'name' => 'X-TKJ']);

        // 2. Buat Data Siswa dan masukkan ke kelas tersebut
        Student::create([
            'nis' => '1001',
            'name' => 'Ahmad Budi',
            'gender' => 'L',
            'class_id' => $kelas1->id, // Masuk ke X-IPA 1
            'card_uid' => 'A1B2C3D4'
        ]);

        Student::create([
            'nis' => '1002',
            'name' => 'Siti Aminah',
            'gender' => 'P',
            'class_id' => $kelas2->id, // Masuk ke X-IPA 2
            'card_uid' => null
        ]);
    }
}