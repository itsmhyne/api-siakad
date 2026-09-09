<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassRoomController;
use App\Models\ClassRoom;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// ===== ATTENDANCE ===== //
Route::post('/attendance/scan', [AttendanceController::class, 'scan']);

// ===== STUDENT ===== //
Route::apiResource('students', StudentController::class);
Route::get('/classes', function () {
    $classes = ClassRoom::orderBy('level')->orderBy('name')->get(['id', 'name']);
    return response()->json($classes);
});

// ===== CLASSROOM ===== //
Route::apiResource('classRoom', ClassRoomController::class);
