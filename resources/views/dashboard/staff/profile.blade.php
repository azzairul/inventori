@extends('dashboard.staff.components.master')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Profil Detail</h1>
    <div class="card shadow p-4">
        @if (auth()->user()->detailUser)
            <form>
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" id="nik" class="form-control" value="{{ auth()->user()->detailUser->nik ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" id="alamat" class="form-control" value="{{ auth()->user()->detailUser->alamat ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="no_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" id="no_telepon" class="form-control" value="{{ auth()->user()->detailUser->no_telepon ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="text" id="tanggal_lahir" class="form-control" value="{{ auth()->user()->detailUser->tanggal_lahir ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <input type="text" id="jenis_kelamin" class="form-control" value="{{ ucfirst(auth()->user()->detailUser->jenis_kelamin) ?? 'Data kosong' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="riwayat_pendidikan" class="form-label">Riwayat Pendidikan</label>
                    <textarea id="riwayat_pendidikan" class="form-control" rows="2" disabled>{{ auth()->user()->detailUser->riwayat_pendidikan ?? 'Data kosong' }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="posisi_dilamar" class="form-label">Posisi Dilamar</label>
                    <input type="text" id="posisi_dilamar" class="form-control" value="{{ auth()->user()->detailUser->posisi_dilamar ?? 'Data kosong' }}" disabled>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('edit.profile') }}" class="btn btn-primary">Edit Profil</a>
                </div>
            </form>
        @else
            <div class="alert alert-warning text-center" role="alert">
                Data profil Anda belum tersedia. Silakan lengkapi data terlebih dahulu.
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('edit.profile') }}" class="btn btn-primary">Lengkapi Data Profil</a>
            </div>
        @endif
    </div>    
</div>
@endsection
