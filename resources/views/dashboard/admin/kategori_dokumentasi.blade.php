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
        <h1 class="h3 text-gray-800">Manajemen Kategori</h1>
        <!-- Add Button -->
        <button class="btn btn-primary" id="addCategoryButton" data-toggle="modal" data-target="#addCategoryModal">
            <i class="fas fa-plus"></i> Tambah Kategori
        </button>
    </div>

    <!-- Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($category->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">Belum ada kategori yang ditambahkan</td>
                            </tr>        
                        @else
                            @foreach ($category as $x)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $x->nama }}</td>
                                    <td>
                                        <button class="btn btn-icon btn-link op-8" data-toggle="modal" data-target="#editCategoryModal{{ $x->id }}">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <!-- Tambahkan aksi Hapus di sini -->
                                        <form action="{{ route('kategori_dokumentasi.destroy', $x->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Edit Category Modal -->
                                <div class="modal fade" id="editCategoryModal{{ $x->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $x->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCategoryModalLabel{{ $x->id }}">Edit Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('kategori_dokumentasi.update',$x->id) }}" id="editCategoryForm">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="editCategoryName">Nama Kategori</label>
                                                        <input type="text" class="form-control" id="editCategoryName" name="nama" value="{{ $x->nama }}" required>
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
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('kategori_dokumentasi.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryName">Nama Kategori</label>
                        <input type="text" class="form-control" id="categoryName" name="nama" placeholder="Masukkan nama kategori" required>
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
