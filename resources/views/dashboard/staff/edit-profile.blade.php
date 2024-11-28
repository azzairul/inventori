@extends('dashboard.staff.components.master')

@section('content')
    <div class="container">
        <h1>Edit Profil</h1>
        <form action="/profile/update" method="POST">
            @csrf
        

            <!-- Data Pribadi -->
            <div class="card mb-3">
                <div class="card-header">Data Pribadi</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                            name="nik" value="{{ old('nik', $detailUser->nik) }}" required>
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label for="jenis_kelamin" style="font-weight: bold; display: block; margin-bottom: 0.5rem;">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required
                            style="width: 100%; padding: 0.5rem; border-radius: 0.25rem; border: 1px solid #ccc; font-size: 1rem;">
                            <option value="" disabled {{ old('jenis_kelamin', $detailUser->jenis_kelamin) == null ? 'selected' : '' }}>
                                -- Pilih Jenis Kelamin --</option>
                            <option value="laki-laki" {{ old('jenis_kelamin', $detailUser->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin', $detailUser->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div style="color: red; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                            id="tempat_lahir" name="tempat_lahir"
                            value="{{ old('tempat_lahir', $detailUser->tempat_lahir) }}" required>
                        @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            id="tanggal_lahir" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $detailUser->tanggal_lahir) }}" required>
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- SC 2: Status -->
<div style="margin-bottom: 1rem;">
    <label for="status" style="font-weight: bold; display: block; margin-bottom: 0.5rem;">Status</label>
    <select class="form-select" id="status" name="status" required
        style="width: 100%; padding: 0.5rem; border-radius: 0.25rem; border: 1px solid #ccc; font-size: 1rem;">
        <option value="" disabled {{ old('status', $detailUser->status) == null ? 'selected' : '' }}>-- Pilih Status --</option>
        <option value="belum menikah" {{ old('status', $detailUser->status) == 'belum menikah' ? 'selected' : '' }}>
            Belum Menikah</option>
        <option value="menikah" {{ old('status', $detailUser->status) == 'menikah' ? 'selected' : '' }}>Menikah</option>
        <option value="bercerai" {{ old('status', $detailUser->status) == 'bercerai' ? 'selected' : '' }}>Bercerai</option>
    </select>
    @error('status')
        <div style="color: red; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
    @enderror
</div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            name="alamat" value="{{ old('alamat', $detailUser->alamat) }}" required>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Posisi dan Jabatan -->
            <div class="card mb-3">
                <div class="card-header">Posisi dan Jabatan</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="divisi" class="form-label">Divisi</label>
                        <input type="text" class="form-control @error('divisi') is-invalid @enderror" id="divisi"
                            name="divisi" value="{{ old('divisi', $detailUser->divisi) }}">
                        @error('divisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan"
                            name="jabatan" value="{{ old('jabatan', $detailUser->jabatan) }}">
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Informasi Kontak -->
            <div class="card mb-3">
                <div class="card-header">Informasi Kontak</div>
                <div class="card-body">
                    <!-- No Telepon -->
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No Telepon</label>
                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                            id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $detailUser->no_telepon) }}"
                            required>
                        @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Instagram -->
                    <div class="mb-3">
                        <label for="instagram" class="form-label">Instagram</label>
                        <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                            id="instagram" name="instagram" value="{{ old('instagram', $detailUser->instagram) }}"
                            required>
                        @error('instagram')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Twitter -->
                    <div class="mb-3">
                        <label for="twiter" class="form-label">Twitter</label>
                        <input type="text" class="form-control @error('twiter') is-invalid @enderror" id="twiter"
                            name="twiter" value="{{ old('twiter', $detailUser->twiter) }}" required>
                        @error('twiter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- LinkedIn -->
                    <div class="mb-3">
                        <label for="linkedin" class="form-label">LinkedIn</label>
                        <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin"
                            name="linkedin" value="{{ old('linkedin', $detailUser->linkedin) }}" required>
                        @error('linkedin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Riwayat Pendidikan -->
            <div class="card mb-3">
                <div class="card-header">Riwayat Pendidikan</div>
                <div class="card-body">
                    <!-- Pendidikan Terakhir -->
                    <div style="margin-bottom: 1rem;">
                        <label for="pendidikan_terakhir" style="font-weight: bold; display: block; margin-bottom: 0.5rem;">Pendidikan Terakhir</label>
                        <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir" required
                            style="width: 100%; padding: 0.5rem; border-radius: 0.25rem; border: 1px solid #ccc; font-size: 1rem;">
                            <option value="" disabled {{ old('pendidikan_terakhir', $detailUser->pendidikan_terakhir) == null ? 'selected' : '' }}>
                                -- Pilih Pendidikan Terakhir --</option>
                            <option value="SMA/SMK" {{ old('pendidikan_terakhir', $detailUser->pendidikan_terakhir) == 'SMA/SMK' ? 'selected' : '' }}>
                                SMA/SMK</option>
                            <option value="Mahasiswa" {{ old('pendidikan_terakhir', $detailUser->pendidikan_terakhir) == 'Mahasiswa' ? 'selected' : '' }}>
                                Mahasiswa</option>
                            <option value="S1" {{ old('pendidikan_terakhir', $detailUser->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('pendidikan_terakhir', $detailUser->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ old('pendidikan_terakhir', $detailUser->pendidikan_terakhir) == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                        @error('pendidikan_terakhir')
                            <div style="color: red; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Nama Institusi -->
                    <div class="mb-3">
                        <label for="nama_institusi" class="form-label">Nama Institusi</label>
                        <input type="text" class="form-control @error('nama_institusi') is-invalid @enderror"
                            id="nama_institusi" name="nama_institusi"
                            value="{{ old('nama_institusi', $detailUser->nama_institusi) }}" required>
                        @error('nama_institusi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jurusan -->
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                            name="jurusan" value="{{ old('jurusan', $detailUser->jurusan) }}" required>
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tahun Lulus -->
                    <div class="mb-3">
                        <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                        <input type="date" class="form-control @error('tahun_lulus') is-invalid @enderror"
                            id="tahun_lulus" name="tahun_lulus"
                            value="{{ old('tahun_lulus', $detailUser->tahun_lulus) }}" required>
                        @error('tahun_lulus')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>


            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
