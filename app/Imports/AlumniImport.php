<?php

namespace App\Imports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class AlumniImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;

    public function model(array $row)
    {
        // Ambil NIM, bersihkan dari spasi
        $nim = isset($row['nim']) ? trim((string) $row['nim']) : null;

        // Generate email unik dari NIM supaya tidak kosong / duplicate
        if ($nim) {
            $email = strtolower($nim) . '@alumni.ac.id';
        } else {
            $email = 'alumni_' . uniqid() . '@alumni.ac.id';
        }

        // Skip baris jika email sudah ada di database
        if (Alumni::where('email', $email)->exists()) {
            return null;
        }

        // Parse tahun lulus dari string seperti "1 Juli 2000"
        $tahunLulus = null;
        if (!empty($row['tanggal_lulus'])) {
            // Coba parse langsung
            $ts = strtotime($row['tanggal_lulus']);
            if ($ts) {
                $tahunLulus = date('Y', $ts);
            } else {
                // Coba ambil 4 digit angka dari string
                preg_match('/\b(19|20)\d{2}\b/', (string) $row['tanggal_lulus'], $matches);
                $tahunLulus = $matches[0] ?? null;
            }
        }

        return new Alumni([
            'nim'         => $nim,
            'nama'        => isset($row['nama_lulusan']) ? trim($row['nama_lulusan']) : null,
            'email'       => $email,
            'tahun_lulus' => $tahunLulus,
            'jurusan'     => isset($row['program_studi']) ? trim($row['program_studi']) : null,
            'fakultas'    => isset($row['fakultas']) ? trim($row['fakultas']) : null,
            // Kolom berikut belum ada di Excel, diisi manual nanti lewat form edit
            'no_hp'             => null,
            'pekerjaan'         => null,
            'instansi'          => null,
            'alamat_kerja'      => null,
            'posisi'            => null,
            'status_kerja'      => null,
            'linkedin'          => null,
            'instagram'         => null,
            'facebook'          => null,
            'tiktok'            => null,
            'sosmed_perusahaan' => null,
        ]);
    }
}
