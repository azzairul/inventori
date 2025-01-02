@extends('dashboard.admin.components.master')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Profil Detail</h1>
    <div class="card shadow p-4">
        @if (auth()->user()->detailUser)
            <form>
                <!-- Data Pribadi -->
                <h3 class="mb-3">Data Pribadi</h3>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label> 
                    <input type="text" id="nama" class="form-control" value="{{ $employee->nama ?? 'Data kosong' }}" disabled> 
                </div>
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" id="nik" class="form-control" value="{{ $employee->nik ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <input type="text" id="jenis_kelamin" class="form-control" value="{{ $employee->jenis_kelamin ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" class="form-control" value="{{ $employee->tempat_lahir ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="text" id="tanggal_lahir" class="form-control" value="{{ $employee->tanggal_lahir ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" id="status" class="form-control" value="{{ $employee->status ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                    <textarea id="alamat_lengkap" class="form-control" rows="2" disabled>{{ $employee->alamat ?? 'Data kosong' }}</textarea>
                </div>

                <!-- Posisi dan Jabatan -->
                <h3 class="mt-4 mb-3">Posisi dan Jabatan</h3>
                <div class="mb-3">
                    <label for="divisi" class="form-label">Divisi</label>
                    <input type="text" id="divisi" class="form-control" value="{{ $employee->divisi ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" id="jabatan" class="form-control" value="{{ $employee->jabatan ?? 'Data kosong' }}" disabled>
                </div>

                <!-- Informasi Kontak -->
                <h3 class="mt-4 mb-3">Informasi Kontak</h3>
                <div class="mb-3">
                    <label for="no_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" id="no_telepon" class="form-control" value="{{ $employee->no_telepon ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" id="instagram" class="form-control" value="{{ $employee->instagram ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="twiter" class="form-label">Twitter</label>
                    <input type="text" id="twiter" class="form-control" value="{{ $employee->twiter ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="linkedin" class="form-label">LinkedIn</label>
                    <input type="text" id="linkedin" class="form-control" value="{{ $employee->linkedin ?? 'Data kosong' }}" disabled>
                </div>

                <!-- Riwayat Pendidikan -->
                <h3 class="mt-4 mb-3">Riwayat Pendidikan</h3>
                <div class="mb-3">
                    <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                    <input type="text" id="pendidikan_terakhir" class="form-control" value="{{$employee->pendidikan_terakhir ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="nama_institusi" class="form-label">Nama Institusi</label>
                    <input type="text" id="nama_institusi" class="form-control" value="{{$employee->nama_institusi ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" id="jurusan" class="form-control" value="{{$employee->jurusan ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                    <input type="text" id="tahun_lulus" class="form-control" value="{{ $employee->tahun_lulus ?? 'Data kosong' }}" disabled>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary">Edit Profil</a>
                </div>
            </form>
        @else
            <div class="alert alert-warning text-center" role="alert">
                Data profil Anda belum tersedia. Silakan lengkapi data terlebih dahulu.
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-primary">Lengkapi Data Profil</a>
            </div>
        @endif
    </div>    
</div>
@endsection
