<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumnis';

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'no_hp',
        'tahun_lulus',
        'jurusan',
        'fakultas',
        'pekerjaan',
        'instansi',
        'alamat_kerja',
        'posisi',
        'status_kerja',
        'linkedin',
        'instagram',
        'facebook',
        'tiktok',
        'sosmed_perusahaan',
    ];
}
