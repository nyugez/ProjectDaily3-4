@extends('layouts.app')

@section('content')

<div class="card">
    <h2>📋 Data Alumni</h2>

    {{-- IMPORT EXCEL --}}
    <form action="/alumni/import" method="POST" enctype="multipart/form-data"
          style="display:flex; gap:10px; align-items:flex-end; flex-wrap:wrap; margin-bottom:20px;
                 padding:16px; background:#f5f5ff; border-radius:8px; border:1px solid #e8eaf6;">
        @csrf
        <div style="flex:1; min-width:200px;">
            <label style="font-size:12px; font-weight:600; color:#555; display:block; margin-bottom:4px;">
                📂 Import dari Excel (.xlsx / .xls / .csv)
            </label>
            <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                   style="font-size:13px;">
        </div>
        <button type="submit" class="btn btn-success">⬆️ Import Excel</button>
    </form>

    {{-- SEARCH + TOMBOL TAMBAH --}}
    <div style="display:flex; gap:10px; justify-content:space-between; flex-wrap:wrap;">
        <form action="/alumni" method="GET" class="search-bar" style="flex:1; max-width:500px;">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="🔍 Cari nama, NIM, jurusan, instansi...">
            <button type="submit" class="btn btn-primary">Cari</button>
            @if(request('search'))
                <a href="/alumni" class="btn btn-secondary">Reset</a>
            @endif
        </form>

        <a href="/alumni/create" class="btn btn-primary">➕ Tambah Alumni</a>
    </div>

    <p style="font-size:13px; color:#666; margin:10px 0;">
        Total: <strong>{{ $data->total() }}</strong> data alumni
    </p>

    {{-- TABEL --}}
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email / No HP</th>
                    <th>Jurusan / Fakultas</th>
                    <th>Lulus</th>
                    <th>Instansi / Posisi</th>
                    <th>Status</th>
                    <th>Sosmed</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $d)
                <tr>
                    <td>{{ $data->firstItem() + $i }}</td>
                    <td>{{ $d->nim ?? '-' }}</td>
                    <td><strong>{{ $d->nama }}</strong></td>
                    <td>
                        <div>{{ $d->email ?? '-' }}</div>
                        <div style="color:#888;">{{ $d->no_hp ?? '-' }}</div>
                    </td>
                    <td>
                        <div>{{ $d->jurusan ?? '-' }}</div>
                        <div style="color:#888; font-size:12px;">{{ $d->fakultas ?? '' }}</div>
                    </td>
                    <td>{{ $d->tahun_lulus ?? '-' }}</td>
                    <td>
                        <div>{{ $d->instansi ?? '-' }}</div>
                        <div style="color:#888; font-size:12px;">{{ $d->posisi ?? '' }}</div>
                        @if($d->alamat_kerja)
                            <div style="color:#aaa; font-size:11px;">📍 {{ $d->alamat_kerja }}</div>
                        @endif
                    </td>
                    <td>
                        @if($d->status_kerja === 'PNS')
                            <span class="badge badge-pns">PNS</span>
                        @elseif($d->status_kerja === 'Swasta')
                            <span class="badge badge-swasta">Swasta</span>
                        @elseif($d->status_kerja === 'Wirausaha')
                            <span class="badge badge-wirausaha">Wirausaha</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td style="font-size:12px; line-height:1.8;">
                        @if($d->linkedin)  <a href="{{ $d->linkedin }}"  target="_blank">🔗 LinkedIn</a><br>@endif
                        @if($d->instagram) <a href="{{ $d->instagram }}" target="_blank">📸 IG</a><br>@endif
                        @if($d->facebook)  <a href="{{ $d->facebook }}"  target="_blank">👤 FB</a><br>@endif
                        @if($d->tiktok)    <a href="{{ $d->tiktok }}"    target="_blank">🎵 TikTok</a><br>@endif
                        @if($d->sosmed_perusahaan) <a href="{{ $d->sosmed_perusahaan }}" target="_blank">🏢 Perusahaan</a>@endif
                        @if(!$d->linkedin && !$d->instagram && !$d->facebook && !$d->tiktok && !$d->sosmed_perusahaan)
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <a href="/alumni/{{ $d->id }}/edit" class="btn btn-warning">✏️ Edit</a>
                        <form action="/alumni/{{ $d->id }}" method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Yakin hapus data {{ $d->nama }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" style="text-align:center; padding:30px; color:#999;">
                        Belum ada data alumni. Import Excel atau tambah manual.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="pagination-wrapper">
        {{ $data->links() }}
    </div>
</div>

@endsection
