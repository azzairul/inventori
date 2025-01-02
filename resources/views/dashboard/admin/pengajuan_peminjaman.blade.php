@extends('dashboard.admin.components.master')

@section('content')
<!-- Header -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<div class="container mt-4">

     <!-- Sorting Options -->
     <div class="mb-3">
        <label for="order" class="form-label fw-semibold text-primary">Urutkan Berdasarkan</label>
        <select name="order" id="order" class="form-select shadow-sm" onchange="window.location.href='?order=' + this.value;">
            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Terbaru</option>
            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Terlama</option>
            
        </select>
    </div>
    <!-- Card Section -->
    <div class="card shadow-lg border-0 rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Pengajuan Peminjaman Barang</h6>
            {{-- <form method="GET" action="{{ url('/admin-dashboard/users') }}" class="d-flex align-items-center">
                <select name="order" class="form-select form-select-sm me-2">
                    <option value="desc" {{ $order == 'desc' ? 'selected' : '' }}>Terbaru</option>
                    <option value="asc" {{ $order == 'asc' ? 'selected' : '' }}>Terlama</option>
                </select>
                <button type="submit" class="btn btn-light btn-sm">
                    <i class="fas fa-sort"></i> Urutkan
                </button>
            </form> --}}
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="liveReportTable" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Jam Peminjaman</th>
                            <th>Nama Peminjam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjaman as $x)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $x->no_transaksi }}</td>
                            <td>{{ $x->tanggal_peminjaman }}</td>
                            <td>20 Desember</td>
                            <td>{{ $x->jam_peminjaman }}</td>
                            <td>{{ $x->nama_peminjam }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary d-flex align-items-center" 
                                            type="button" id="actionDropdown{{ $x->id }}" 
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-cogs me-2"></i> Aksi
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $x->id }}">
                                        <li>
                                            <button class="dropdown-item viewItems" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#viewItemsModal" 
                                                    data-transaction-id="{{ $x->id }}">
                                                <i class="fas fa-eye text-info me-2"></i> Lihat
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item approveTransaction" data-id="{{ $x->id }}">
                                                <i class="fas fa-check-circle text-success me-2"></i> Acc
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item rejectTransaction" 
                                                    data-id="{{ $x->id }}">
                                                <i class="fas fa-times-circle text-danger me-2"></i> Tolak
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item deleteTransaction" 
                                                    data-id="{{ $x->id }}">
                                                <i class="fas fa-trash-alt text-warning me-2"></i> Hapus
                                            </button>
                                        </li>
                                    </ul>                                    
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal View Items -->
<div class="modal fade" id="viewItemsModal" tabindex="-1" aria-labelledby="viewItemsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Modal Lebih Besar -->
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewItemsModalLabel">Detail Barang Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabel dengan Desain Profesional dan Elegan -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" style="font-size: 0.9rem; border-radius: 10px;">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center">Kode Barang</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Lokasi Peminjaman</th>
                                <th class="text-center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="modalItemsTableBody">
                            <!-- Dynamic Content -->
                            <!-- Data akan dimuat menggunakan JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('click', '.viewItems', function () {
    const transactionId = $(this).data('transaction-id'); // Ambil transaction ID dari elemen

    // Fetch data menggunakan AJAX
    $.ajax({
        url: `/peminjaman-items/${transactionId}`, // URL untuk API
        method: 'GET',
        success: function (response) {
            // Tambahkan log untuk melihat respon dari server
            console.log(response); // Debugging: tampilkan data yang diterima dari API

            if (response.items) {
                $('#modalItemsTableBody').empty(); // Kosongkan data sebelumnya

                // Loop melalui data items dan tampilkan ke dalam modal
                response.items.forEach(item => {
                    $('#modalItemsTableBody').append(`
                        <tr>
                            <td>${item.kode_barang}</td>
                            <td>${item.nama_barang}</td>
                            <td>${item.kategori}</td>
                            <td>${item.lokasi}</td>
                            <td>${item.jumlah_unit}</td>
                        </tr>
                    `);
                });

                // Tampilkan modal
                $('#viewItemsModal').modal('show'); // Pastikan modal ditampilkan setelah data dimuat
            } else {
                alert('Data tidak ditemukan.');
            }
        },
        error: function () {
            alert('Gagal memuat data.');
        }
    });
});

$(document).on('click', '.approveTransaction', function () {
    const transactionId = $(this).data('id'); // Ambil ID transaksi

    // Konfirmasi dari pengguna sebelum melakukan perubahan
    if (confirm('Apakah Anda yakin ingin menerima peminjaman ini?')) {
        $.ajax({
            url: `/peminjaman/acc/${transactionId}`, // URL untuk API
            method: 'PATCH',
            data: {
                // Data lain yang ingin dikirim jika ada
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Menambahkan CSRF token ke header
            },
            success: function (response) {
                alert(response.message); // Tampilkan pesan sukses
                // Lakukan refresh atau update tampilan jika diperlukan
                location.reload(); // Bisa mengganti dengan pembaruan lokal jika tidak ingin refresh halaman
            },
            error: function () {
                alert('Gagal menerima transaksi.');
            }
        });
    }
});

$(document).on('click', '.rejectTransaction', function () {
    const transactionId = $(this).data('id'); // Ambil ID transaksi

    // Konfirmasi dari pengguna sebelum melakukan perubahan
    if (confirm('Apakah Anda yakin ingin menolak peminjaman ini?')) {
        $.ajax({
            url: `/peminjaman/tolak/${transactionId}`, // URL untuk API
            method: 'PATCH',
            data: {
                // Data lain yang ingin dikirim jika ada
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Menambahkan CSRF token ke header
            },
            success: function (response) {
                alert(response.message); // Tampilkan pesan sukses
                // Lakukan refresh atau update tampilan jika diperlukan
                location.reload(); // Bisa mengganti dengan pembaruan lokal jika tidak ingin refresh halaman
            },
            error: function () {
                alert('Gagal menerima transaksi.');
            }
        });
    }
});


</script>

@endsection
