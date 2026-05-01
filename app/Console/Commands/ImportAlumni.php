<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\AlumniImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Alumni;

class ImportAlumni extends Command
{
    protected $signature = 'alumni:import {file}';
    protected $description = 'Import data alumni dari file Excel';

    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error('File tidak ditemukan: ' . $file);
            return;
        }

        $this->info('Mulai import data alumni...');
        $this->info('File: ' . $file);

        ini_set('memory_limit', '512M');
        set_time_limit(0);

        try {
            Excel::import(new AlumniImport, $file);
            $total = Alumni::count();
            $this->info('✅ Import selesai! Total data alumni: ' . number_format($total));
        } catch (\Throwable $e) {
            $this->error('❌ Import gagal: ' . $e->getMessage());
        }
    }
}
