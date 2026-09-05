<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function scan(Request $request)
    {
        // 1. Validasi input dari IoT
        $request->validate([
            'card_uid' => 'required|string'
        ]);

        // 2. Cari data siswa berdasarkan kartu
        $student = Student::where('card_uid', $request->card_uid)->first();

        // 3. Jika kartu tidak terdaftar
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Kartu Tidak Dikenal'
            ], 404);
        }

        // 4. Catat absen
        Attendance::create([
            'student_id' => $student->id,
            'scanned_at' => now(),
            'status' => 'hadir'
        ]);

        // 5. Kembalikan respons sukses ke alat IoT/Frontend
        return response()->json([
            'success' => true,
            'message' => $student->name
        ], 200);
    }
}