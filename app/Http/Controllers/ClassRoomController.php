<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = ClassRoom::query();

        return response()->json($query->paginate(10), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'level'=> 'required|int',
            'name' => 'required|string',
            'major' => 'nullable|string'
        ]);

        $classRoom = ClassRoom::create($validate);

        return response()->json(['message' => 'Kelas berhasil ditambahkan', 'data' => $classRoom], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $classRoom = ClassRoom::findOrFail($id);

    // 1. Hapus semua .$id, dan ganti 'int' menjadi 'integer'
    $validated = $request->validate([
        'level' => 'required|integer',
        'name'  => 'required|string|max:255',
        'major' => 'nullable|string|max:255'
    ]);

    $classRoom->update($validated);

    // 2. Ubah $student menjadi $classRoom
    return response()->json([
        'message' => 'Data kelas berhasil diperbarui', 
        'data' => $classRoom 
    ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ClassRoom::destroy($id);
        return response()->json(['message' => 'Kelas berhasil dihapus'], 200);
    }
}
