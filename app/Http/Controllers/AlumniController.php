<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use App\Imports\AlumniImport;
use Maatwebsite\Excel\Facades\Excel;

class AlumniController extends Controller
{
    // TAMPIL DATA (dengan pencarian)
    public function index(Request $request)
    {
        $query = Alumni::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nim', 'like', "%$search%")
                  ->orWhere('jurusan', 'like', "%$search%")
                  ->orWhere('instansi', 'like', "%$search%");
            });
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_lulus', $request->tahun);
        }

        if ($request->filled('fakultas')) {
            $query->where('fakultas', 'like', '%' . $request->fakultas . '%');
        }

        // 25 data per halaman agar tidak berat di browser
        $data = $query->paginate(25)->withQueryString();

        return view('alumni.index', compact('data'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('alumni.create');
    }

    // SIMPAN DATA BARU
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim'               => 'nullable|string|max:20',
            'nama'              => 'required|string|max:255',
            'email'             => 'nullable|email|unique:alumnis,email|max:255',
            'no_hp'             => 'nullable|string|max:20',
            'tahun_lulus'       => 'nullable|digits:4|integer|min:1990|max:' . date('Y'),
            'jurusan'           => 'nullable|string|max:255',
            'fakultas'          => 'nullable|string|max:255',
            'pekerjaan'         => 'nullable|string|max:255',
            'instansi'          => 'nullable|string|max:255',
            'alamat_kerja'      => 'nullable|string|max:500',
            'posisi'            => 'nullable|string|max:255',
            'status_kerja'      => 'nullable|in:PNS,Swasta,Wirausaha',
            'linkedin'          => 'nullable|string|max:255',
            'instagram'         => 'nullable|string|max:255',
            'facebook'          => 'nullable|string|max:255',
            'tiktok'            => 'nullable|string|max:255',
            'sosmed_perusahaan' => 'nullable|string|max:255',
        ]);

        Alumni::create($validated);

        return redirect('/alumni')->with('success', 'Data alumni berhasil ditambahkan!');
    }

    // FORM EDIT
    public function edit(Alumni $alumni)
    {
        return view('alumni.edit', compact('alumni'));
    }

    // UPDATE DATA
    public function update(Request $request, Alumni $alumni)
    {
        $validated = $request->validate([
            'nim'               => 'nullable|string|max:20',
            'nama'              => 'required|string|max:255',
            'email'             => 'nullable|email|unique:alumnis,email,' . $alumni->id . '|max:255',
            'no_hp'             => 'nullable|string|max:20',
            'tahun_lulus'       => 'nullable|digits:4|integer|min:1990|max:' . date('Y'),
            'jurusan'           => 'nullable|string|max:255',
            'fakultas'          => 'nullable|string|max:255',
            'pekerjaan'         => 'nullable|string|max:255',
            'instansi'          => 'nullable|string|max:255',
            'alamat_kerja'      => 'nullable|string|max:500',
            'posisi'            => 'nullable|string|max:255',
            'status_kerja'      => 'nullable|in:PNS,Swasta,Wirausaha',
            'linkedin'          => 'nullable|string|max:255',
            'instagram'         => 'nullable|string|max:255',
            'facebook'          => 'nullable|string|max:255',
            'tiktok'            => 'nullable|string|max:255',
            'sosmed_perusahaan' => 'nullable|string|max:255',
        ]);

        $alumni->update($validated);

        return redirect('/alumni')->with('success', 'Data alumni berhasil diupdate!');
    }

    // HAPUS DATA
    public function destroy(Alumni $alumni)
    {
        $alumni->delete();
        return redirect('/alumni')->with('success', 'Data alumni berhasil dihapus!');
    }

    // IMPORT EXCEL
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:2097152',
        ]);

        try {
            set_time_limit(0);
            ini_set('memory_limit', '512M');

            $import = new AlumniImport;
            Excel::import($import, $request->file('file'));

            $total = Alumni::count();
            return redirect('/alumni')
                ->with('success', 'Import berhasil! Total data alumni: ' . number_format($total));

        } catch (\Throwable $e) {
            return redirect('/alumni')
                ->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }
}
