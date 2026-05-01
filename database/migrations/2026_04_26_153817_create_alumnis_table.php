<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();

            // DATA UTAMA
            $table->string('nim', 20)->nullable();
            $table->string('nama');
            $table->string('email')->nullable()->unique()->index();
            $table->string('no_hp', 20)->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('fakultas')->nullable();

            // DATA PEKERJAAN
            $table->string('pekerjaan')->nullable();
            $table->string('instansi')->nullable();
            $table->string('alamat_kerja')->nullable();
            $table->string('posisi')->nullable();
            $table->enum('status_kerja', ['PNS', 'Swasta', 'Wirausaha'])->nullable();

            // SOSIAL MEDIA PRIBADI
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();

            // SOSIAL MEDIA PERUSAHAAN
            $table->string('sosmed_perusahaan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
