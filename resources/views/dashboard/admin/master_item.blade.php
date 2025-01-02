@extends('dashboard.admin.components.master')
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
        <h1 class="h3 text-gray-800">Manajemen Barang</h1>
        <!-- Add Button -->
        <button class="btn btn-primary" id="addItemButton" data-toggle="modal" data-target="#addItemModal">
            <i class="fas fa-plus"></i> Tambah Barang
        </button>
    </div>

    <!-- Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($item->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center">Belum ada barang yang ditambahkan</td>
                            </tr>        
                        @else
                            @foreach ($item as $x)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $x->kode_barang }}</td>
                                    <td>{{ $x->nama_barang }}</td>
                                    <td>{{ $x->category->nama }}</td>
                                    <td>{{ $x->stok }}</td>
                                    <td>{{ $x->lokasi }}</td>
                                    <td>{{ $x->status }}</td>
                                    <td>
                                        <button class="btn btn-icon btn-link op-8" data-toggle="modal" data-target="#editItemModal{{ $x->id }}">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <!-- Tambahkan aksi Hapus di sini -->
                                        <form action="{{ route('item.destroy', $x->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Edit Item Modal -->
                                <div class="modal fade" id="editItemModal{{ $x->id }}" tabindex="-1" aria-labelledby="editItemModalLabel{{ $x->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editItemModalLabel{{ $x->id }}">Edit Barang</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('item.update', $x->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <!-- Kode Barang -->
                                                    <div class="form-group">
                                                        <label for="kodeBarang{{ $x->id }}">Kode Barang</label>
                                                        <input type="text" class="form-control" id="kodeBarang{{ $x->id }}" name="kode_barang" 
                                                            value="{{ old('kode_barang', $x->kode_barang) }}" required>
                                                    </div>

                                                    <!-- Nama Barang -->
                                                    <div class="form-group">
                                                        <label for="namaBarang{{ $x->id }}">Nama Barang</label>
                                                        <input type="text" class="form-control" id="namaBarang{{ $x->id }}" name="nama" 
                                                            value="{{ old('nama', $x->nama_barang) }}" required>
                                                    </div>

                                                    <!-- Kategori -->
                                                    <div class="form-group">
                                                        <label for="kategori{{ $x->id }}">Kategori</label>
                                                        <select class="form-control" id="kategori{{ $x->id }}" name="category" required>
                                                            <option value="" disabled selected>Pilih Kategori</option>
                                                            @foreach ($category as $categories) <!-- Menggunakan $categories di dalam loop -->
                                                                <option value="{{ $categories->id }}" 
                                                                        {{ old('category', $x->category_id) == $categories->id ? 'selected' : '' }}>
                                                                    {{ $categories->nama }} <!-- Ganti 'nama' dengan field kategori yang benar -->
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Stok -->
                                                    <div class="form-group">
                                                        <label for="stok{{ $x->id }}">Stok</label>
                                                        <input type="number" class="form-control" id="stok{{ $x->id }}" name="stok" 
                                                            value="{{ old('stok', $x->stok) }}" required>
                                                    </div>

                                                    <!-- Lokasi -->
                                                    <div class="form-group">
                                                        <label for="lokasi{{ $x->id }}">Lokasi</label>
                                                        <input type="text" class="form-control" id="lokasi{{ $x->id }}" name="lokasi" 
                                                            value="{{ old('lokasi', $x->lokasi) }}" required>
                                                    </div>

                                                    <!-- Status -->
                                                    <div class="form-group">
                                                        <label for="status{{ $x->id }}">Status</label>
                                                        <select class="form-control" id="status{{ $x->id }}" name="status" required>
                                                            <option value="tersedia" {{ old('status', $x->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                                            <option value="tidak tersedia" {{ old('status', $x->status) == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('item.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kodebarang">Kode Barang</label>
                        <input type="text" class="form-control" id="kodebarang" name="kode_barang" placeholder="Masukkan kode barang" required>
                    </div>
                    <div class="form-group">
                        <label for="namabarang">Nama Barang</label>
                        <input type="text" class="form-control" id="namabarang" name="nama" placeholder="Masukkan nama barang" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="category" required>
                            <option value="" disabled selected>Pilih kategori</option>
                            @foreach($category as $categories)
                                <option value="{{ $categories->id }}">{{ $categories->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control" id="stok" name="stok" placeholder="Masukkan jumlah stok barang" required>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi Barang</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukkan lokasi barang" required>
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
