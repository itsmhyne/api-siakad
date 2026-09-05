<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            
            // Tingkat kelas: 10, 11, 12 (Tipe integer agar mudah di-filter/diurutkan)
            $table->integer('level'); 
            
            // Nama tampil: "X-IPA 1", "XI-RPL A"
            $table->string('name', 50); 
            
            // Jurusan (Opsional, khusus SMK/SMA): "IPA", "IPS", "RPL"
            $table->string('major', 50)->nullable(); 
            
            // Wali Kelas (Opsional, di-uncomment jika tabel teachers sudah kamu buat)
            // $table->foreignId('homeroom_teacher_id')->nullable()->constrained('teachers')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
};