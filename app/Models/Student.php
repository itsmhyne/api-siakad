<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $guarded = ['id'];

    // Relasi: Siswa ini berada di Kelas mana?
    public function classRoom(): BelongsTo
    {
        // Mengarah ke model ClassRoom, menggunakan kolom class_id
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }
}