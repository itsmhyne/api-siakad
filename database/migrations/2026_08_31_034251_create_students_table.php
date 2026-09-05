<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        
        // Identitas
        $table->string('nis', 20)->unique();
        $table->string('nisn', 20)->nullable()->unique();
        $table->string('nik', 20)->nullable()->unique();
        $table->string('card_uid', 50)->nullable()->unique(); // Kartu RFID
        
        // Biodata
        $table->string('name');
        $table->enum('gender', ['L', 'P']);
        $table->string('place_of_birth')->nullable();
        $table->date('date_of_birth')->nullable();
        $table->string('religion', 20)->nullable();
        
        // Kontak
        $table->text('address')->nullable();
        $table->string('phone_number', 20)->nullable();
        $table->string('email')->nullable()->unique(); // Untuk login siswa
        
        // Orang Tua
        $table->string('father_name')->nullable();
        $table->string('mother_name')->nullable();
        $table->string('parent_phone', 20)->nullable(); // Target notif WA absen
        
        // Akademik
        $table->foreignId('class_id')->nullable()->constrained('classes')->nullOnDelete();
        $table->enum('status', ['active', 'graduated', 'transferred', 'dropped'])->default('active');
        $table->date('enrollment_date')->nullable();
        
        $table->timestamps();
        $table->softDeletes(); // Agar data tidak benar-benar terhapus (aman untuk histori nilai)
    });
}
};
