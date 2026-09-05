<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('classRoom');

        // Filter Pencarian Teks
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'ilike', "%{$search}%")
                  ->orWhere('nis', 'ilike', "%{$search}%");
            });
        }

        // [BARU] Filter Berdasarkan Kelas
        // [PERBAIKAN] Filter Berdasarkan Kelas yang Tahan Banting
        if ($request->filled('class_id')) {
            $classId = $request->class_id;
            
            // Cek apakah bukan teks "all" DAN wajib berupa angka
            if ($classId !== 'all' && is_numeric($classId)) {
                $query->where('class_id', $classId);
            }
        }

        // Fitur Sortir (Tetap)
        $sortBy = $request->query('sort_by', 'name');
        $sortDir = $request->query('sort_dir', 'asc');
        
        $allowedSorts = ['nis', 'name', 'card_uid'];
        if (in_array($sortBy, $allowedSorts)) {
            $direction = $sortDir === 'desc' ? 'desc' : 'asc';
            $query->orderBy($sortBy, $direction);
        }

        return response()->json($query->paginate(10), 200);
    }

    // SIMPAN DATA BARU
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:20|unique:students,nis',
            'nisn' => 'nullable|string|max:20|unique:students,nisn',
            'nik' => 'nullable|string|max:20|unique:students,nik',
            'card_uid' => 'nullable|string|max:50|unique:students,card_uid',
            
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'religion' => 'nullable|string|max:20',
            
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:students,email',
            
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            
            'class_id' => 'nullable|exists:classes,id',
            'status' => 'nullable|in:active,graduated,transferred,dropped',
            'enrollment_date' => 'nullable|date',
        ]);

        $student = Student::create($validated);
        return response()->json(['message' => 'Siswa berhasil ditambahkan', 'data' => $student], 201);
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        $validated = $request->validate([
            'nis' => 'required|string|max:20|unique:students,nis,' . $id,
            'nisn' => 'nullable|string|max:20|unique:students,nisn,' . $id,
            'nik' => 'nullable|string|max:20|unique:students,nik,' . $id,
            'card_uid' => 'nullable|string|max:50|unique:students,card_uid,' . $id,
            
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'religion' => 'nullable|string|max:20',
            
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:students,email,' . $id,
            
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            
            'class_id' => 'nullable|exists:classes,id',
            'status' => 'nullable|in:active,graduated,transferred,dropped',
            'enrollment_date' => 'nullable|date',
        ]);

        $student->update($validated);
        return response()->json(['message' => 'Data siswa berhasil diperbarui', 'data' => $student], 200);
    }

    // HAPUS DATA
    public function destroy($id)
    {
        Student::destroy($id);
        return response()->json(['message' => 'Siswa berhasil dihapus'], 200);
    }
}