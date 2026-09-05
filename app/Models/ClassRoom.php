<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassRoom extends Model
{
    // WAJIB: Beri tahu Laravel nama tabel aslinya
    protected $table = 'classes';

    protected $guarded = ['id'];

    // Relasi: Kelas ini memiliki banyak Siswa
    public function students(): HasMany
    {
        // Parameter 2 adalah nama foreign_key di tabel students
        return $this->hasMany(Student::class, 'class_id'); 
    }
}