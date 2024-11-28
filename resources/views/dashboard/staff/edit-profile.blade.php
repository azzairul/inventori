@extends('dashboard.staff.components.master')

@section('content')
<div class="container">
    <div class="card shadow p-4">
        <h4 class="mb-4">Edit Profil</h4>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('update.profile') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror"
                       value="{{ old('nik', $detailUser->nik ?? '') }}">
                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                       value="{{ old('alamat', $detailUser->alamat ?? '') }}">
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">Nomor Telepon</label>
                <input type="text" id="no_telepon" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror"
                       value="{{ old('no_telepon', $detailUser->no_telepon ?? '') }}">
                @error('no_telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                       value="{{ old('tanggal_lahir', $detailUser->tanggal_lahir ?? '') }}">
                @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                    <option value="" {{ old('jenis_kelamin', $detailUser->jenis_kelamin ?? '') == '' ? 'selected' : '' }}>Pilih</option>
                    <option value="laki-laki" {{ old('jenis_kelamin', $detailUser->jenis_kelamin ?? '') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="perempuan" {{ old('jenis_kelamin', $detailUser->jenis_kelamin ?? '') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="riwayat_pendidikan" class="form-label">Riwayat Pendidikan</label>
                <textarea id="riwayat_pendidikan" name="riwayat_pendidikan" class="form-control @error('riwayat_pendidikan') is-invalid @enderror" rows="3">{{ old('riwayat_pendidikan', $detailUser->riwayat_pendidikan ?? '') }}</textarea>
                @error('riwayat_pendidikan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="posisi_dilamar" class="form-label">Posisi Dilamar</label>
                <input type="text" id="posisi_dilamar" name="posisi_dilamar" class="form-control @error('posisi_dilamar') is-invalid @enderror"
                       value="{{ old('posisi_dilamar', $detailUser->posisi_dilamar ?? '') }}">
                @error('posisi_dilamar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
