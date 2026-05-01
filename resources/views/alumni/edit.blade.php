@extends('layouts.app')

@section('content')

<div class="card">
    <h2>✏️ Edit Data Alumni — {{ $alumni->nama }}</h2>

    <form action="{{ route('alumni.update', $alumni->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- DATA PRIBADI --}}
        <div class="section-title">Data Pribadi</div>
        <div class="form-row">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" value="{{ old('nim', $alumni->nim) }}" placeholder="Nomor Induk Mahasiswa">
                @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Nama Lengkap <span style="color:red">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $alumni->nama) }}" required>
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $alumni->email) }}" placeholder="email@domain.com">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>No. HP / WhatsApp</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $alumni->no_hp) }}" placeholder="08xxxxxxxxxx">
                @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row-3">
            <div class="form-group">
                <label>Tahun Lulus</label>
                <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}" min="1990" max="{{ date('Y') }}">
                @error('tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Program Studi</label>
                <input type="text" name="jurusan" value="{{ old('jurusan', $alumni->jurusan) }}">
                @error('jurusan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Fakultas</label>
                <input type="text" name="fakultas" value="{{ old('fakultas', $alumni->fakultas) }}">
                @error('fakultas') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- PEKERJAAN --}}
        <div class="section-title">Informasi Pekerjaan</div>
        <div class="form-row">
            <div class="form-group">
                <label>Tempat Bekerja / Instansi</label>
                <input type="text" name="instansi" value="{{ old('instansi', $alumni->instansi) }}">
                @error('instansi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Jenis Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $alumni->pekerjaan) }}">
                @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Posisi / Jabatan</label>
                <input type="text" name="posisi" value="{{ old('posisi', $alumni->posisi) }}">
                @error('posisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Status Pekerjaan</label>
                <select name="status_kerja">
                    <option value="">-- Pilih Status --</option>
                    <option value="PNS"       {{ old('status_kerja', $alumni->status_kerja) == 'PNS'       ? 'selected' : '' }}>PNS</option>
                    <option value="Swasta"    {{ old('status_kerja', $alumni->status_kerja) == 'Swasta'    ? 'selected' : '' }}>Swasta</option>
                    <option value="Wirausaha" {{ old('status_kerja', $alumni->status_kerja) == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                </select>
                @error('status_kerja') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Alamat Tempat Bekerja</label>
            <input type="text" name="alamat_kerja" value="{{ old('alamat_kerja', $alumni->alamat_kerja) }}">
            @error('alamat_kerja') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- SOSMED PRIBADI --}}
        <div class="section-title">Sosial Media Pribadi</div>
        <div class="form-row">
            <div class="form-group">
                <label>LinkedIn</label>
                <input type="text" name="linkedin" value="{{ old('linkedin', $alumni->linkedin) }}" placeholder="https://linkedin.com/in/username">
                @error('linkedin') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Instagram</label>
                <input type="text" name="instagram" value="{{ old('instagram', $alumni->instagram) }}" placeholder="https://instagram.com/username">
                @error('instagram') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Facebook</label>
                <input type="text" name="facebook" value="{{ old('facebook', $alumni->facebook) }}" placeholder="https://facebook.com/username">
                @error('facebook') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>TikTok</label>
                <input type="text" name="tiktok" value="{{ old('tiktok', $alumni->tiktok) }}" placeholder="https://tiktok.com/@username">
                @error('tiktok') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- SOSMED PERUSAHAAN --}}
        <div class="section-title">Sosial Media Tempat Bekerja</div>
        <div class="form-group">
            <label>Akun Sosial Media Perusahaan / Instansi</label>
            <input type="text" name="sosmed_perusahaan" value="{{ old('sosmed_perusahaan', $alumni->sosmed_perusahaan) }}">
            @error('sosmed_perusahaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- TOMBOL --}}
        <div class="btn-actions">
            <button type="submit" class="btn btn-primary">💾 Update Data</button>
            <a href="{{ route('alumni.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>
    </form>
</div>

@endsection
