@extends('dashboard.admin.components.master')

@section('content')
    <div class="container-fluid">

        <!-- modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="addUserForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Tambah User Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit User -->
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="userId" name="userId">
                            <input type="hidden" class="form-control" id="password" name="password" required>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="editName" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Manajemen User</h1>

        <div class="">
            <!-- Bagian Atas: Pencarian dan Tambah Data -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Form Pencarian -->
                <form class="d-flex" method="GET" action="{{ url('/admin-dashboard/users') }}">
                    <input type="text" name="search" class="form-control" placeholder="Cari pengguna..."
                        value="{{ $search }}" style="display: inline-block;width:300px">
                    <button type="submit" class="btn btn-primary ms-2">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </form>
                <!-- Tombol Tambah Data -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUserModal">
                    <i class="fas fa-plus me-1"></i> Tambah Data
                </button>
                
            </div>

            <!-- Bagian Bawah: Filter dan Tombol Sort -->
            <div class="card shadow-sm border-0 mb-2">
                <div class="card-body">
                    <form method="GET" action="{{ url('/admin-dashboard/users') }}" class="row g-2 align-items-center">
                        <!-- Pilihan Sort -->
                        <div class="col-md-6 col-12">
                            <select name="order" class="form-select" 
                                style="width: 100%; height: 38px; font-size: 16px; padding: 10px; 
                                       background-color: #f8f9fa; border-radius: 5px; 
                                       box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                                       border: 1px solid #ced4da;">
                                <option value="desc" {{ $order == 'desc' ? 'selected' : '' }}>Terbaru</option>
                                <option value="asc" {{ $order == 'asc' ? 'selected' : '' }}>Terlama</option>
                            </select>
                        </div>
                        

                        <!-- Tombol Sort -->
                        <div class="col-md-6 col-12 text-md-end">
                            <button type="submit" class="btn btn-secondary w-100">
                                <i class="fas fa-sort me-1"></i> Urutkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- DataTable -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users Data</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm edit-btn"
                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}" data-password="{{ $user->password }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <form action="/admin-dashboard/users/{{ $user->id }}" method="POST"
                                            class="d-inline" id="deleteForm{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $user->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $users->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Cek apakah ada pesan sukses di session
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if (session('success_update'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success_update') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            // Reset form saat modal ditutup
            $('#addUserModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset(); // Reset semua input di dalam modal
            });

            document.getElementById('addUserForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                fetch("{{ url('/admin-dashboard/users') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(response => response.text()) // Ubah sementara jadi `text` untuk debugging
                    .then(data => {
                        console.log(data); // Lihat isi respons
                        const json = JSON.parse(data); // Parsing setelah memastikan respons benar
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: json.success,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // Reset form input setelah berhasil
                            document.getElementById('addUserForm').reset();
                            // Tutup modal
                            $('#addUserModal').modal('hide');
                            // Refresh halaman
                            location.reload();
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan, coba lagi!',
                        });
                    });
            });
        });

        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const form = document.getElementById('deleteForm' + userId);

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim form jika konfirmasi 'Hapus'
                    }
                });
            });
        });


        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const email = this.getAttribute('data-email');
                const password = this.getAttribute('data-password');

                // Isi form modal dengan data dari tombol edit
                document.getElementById('userId').value = userId;
                document.getElementById('editName').value = name;
                document.getElementById('editEmail').value = email;
                document.getElementById('password').value = password;

                // Set action form dengan URL yang sesuai
                const editForm = document.getElementById('editUserForm');
                editForm.action = `/admin-dashboard/users/${userId}`; // Pastikan URL sesuai dengan route

                // Tampilkan modal
                $('#editUserModal').modal('show');
            });
        });
    </script>
@endsection
