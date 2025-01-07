@extends('dashboard.staff.components.master')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- FontAwesome CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="style5.css">

@section('content')
<div class="container mt-5">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Manajemen Peminjaman</h1>
        <!-- Add Button -->
        <button class="btn btn-primary" id="addPeminjamanButton" data-toggle="modal" data-target="#addPeminjamanModal">
            <i class="fas fa-plus"></i> Tambah List Peminjamamn
        </button>
    </div>

    <!-- Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar peminjaman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Jam Peminjaman</th>
                            <th>Nama Peminjam</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($peminjaman->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">Belum ada peminjaman yang diajukan</td>
                            </tr>        
                        @else
                            @foreach ($peminjaman as $x)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $x->no_transaksi }}</td>
                                    <td>{{ $x->tanggal_peminjaman }}</td>
                                    <td>{{ $x->tanggal_pengembalian }}</td>
                                    <td>{{ $x->jam_peminjaman }}</td>
                                    <td>{{ $x->nama_peminjam }}</td>
                                    <td>{{ $x->status }}</td>
                                    <td>
                                        <a href="{{ route('peminjaman.detail', $x->id) }}" class="btn btn-icon btn-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <!-- Tambahkan aksi Hapus di sini -->
                                        <form action="{{ route('peminjaman.destroy', $x->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addPeminjamanModal" tabindex="-1" aria-labelledby="addPeminjamanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('peminjaman.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPeminjamanModalLabel">Tambah Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" required>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
                        </div>
                    <div class="form-group">
                        <label for="jam_peminjaman">Jam Peminjaman</label>
                        <input type="time" class="form-control" id="jam_peminjaman" name="jam_peminjaman" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

@endsection
