@extends('dashboard.staff.components.master')

@section('content')
<!-- Header -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Wrapper -->
    <div class="card shadow-lg border-0">
        <!-- Header -->
        <div class="card-header bg-primary-gradient text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold">
                    <i class="fas fa-history me-2"></i>Riwayat Peminjaman Barang Staff
                </h5>
                <button class="btn btn-sm btn-light shadow-sm" onclick="location.reload()">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Filter dan Search -->
            <form method="GET" action="{{ url('/staff-dashboard/returns') }}" class="row g-3 align-items-center mb-3">
                <div class="col-lg-6 col-md-6">
                    <select name="order" class="form-select shadow-sm border-primary" onchange="this.form.submit()">
                        <option value="desc" {{ $order == 'desc' ? 'selected' : '' }}>Urutkan berdasarkan terbaru</option>
                        <option value="asc" {{ $order == 'asc' ? 'selected' : '' }}>Urutkan berdasarkan terlama</option>
                        <option value="ACC" {{ $order == 'ACC' ? 'selected' : '' }}>Status disetujui (ACC)</option>
                        <option value="Tolak" {{ $order == 'Tolak' ? 'selected' : '' }}>Status ditolak</option>
                    </select>
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" id="liveReportSearch" class="form-control shadow-sm border-primary" placeholder="Cari data..." />
                </div>
            </form>

            <!-- Tabel -->
            <div class="table-responsive">
                <table id="liveReportTable" class="table table-striped table-hover align-middle shadow-sm">
                    <thead style="background-color: #4e73df; color: white;">
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
                        @foreach($returns as $index => $return)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $return->no_transaksi }}</td>
                            <td>{{ $return->tanggal_peminjaman }}</td>
                            <td>{{ $return->tanggal_pengembalian }}</td>
                            <td>{{ $return->jam_peminjaman }}</td>
                            <td>{{ $return->nama_peminjam }}</td>
                            <td>
                                <span class="badge 
                                    {{ $return->status == 'Returned' ? 'bg-success' : ($return->status == 'ACC' ? 'bg-primary' : 'bg-warning') }}">
                                    {{ $return->status }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary viewItems" 
                                        data-id="{{ $return->id }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#viewItemsModal">
                                    <i class="fas fa-eye"></i>
                                </button>
                        
                                @if($return->status === 'diterima')
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                @endif
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary-gradient text-white">
                <h5 class="modal-title">
                    <i class="fas fa-box-open me-2"></i>Detail Barang Peminjaman
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Lokasi Peminjaman</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="modalItemsTableBody">
                            <tr>
                                <td colspan="5" class="text-center text-muted">Memuat data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn text-white bg-primary-gradient" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>



<!-- CSS Kustom -->
<style>
    body {
        background-color: #f8f9fc;
    }

    .bg-primary-gradient {
        background: linear-gradient(90deg, #4e73df, #224abe);
    }

    .btn {
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .table-hover tbody tr:hover {
        background-color: #e9f4ff !important;
    }

    .badge {
        font-size: 0.9rem;
        padding: 0.4rem 0.6rem;
    }

    .modal-header {
        border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    }

    .modal-footer {
        border-top: 2px solid rgba(255, 255, 255, 0.2);
    }

    .form-select,
    .form-control {
        transition: box-shadow 0.2s ease;
    }

    .form-select:focus,
    .form-control:focus {
        box-shadow: 0 0 5px #4e73df;
    }
</style>

<!-- Script -->


<script>
    $(document).ready(function() {
        const table = $('#liveReportTable').DataTable({
            dom: 'lrtip'
        });

        $('#liveReportSearch').on('keyup', function () {
            table.search(this.value).draw();
        });
    });
</script>

<script>
$(document).ready(function () {
    // Ketika tombol "viewItems" diklik
    $('.viewItems').on('click', function () {
        const peminjamanId = $(this).data('id'); // Pastikan tombol memiliki atribut data-id

        // Menggunakan fetch untuk memanggil API
        fetch(`/api/peminjaman-items/${peminjamanId}`) // Gunakan fetch API
            .then(response => response.json()) // Convert response ke format JSON
            .then(data => {
                console.log(data); // Debugging: tampilkan data yang diterima dari API

                $('#modalItemsTableBody').empty(); // Kosongkan data sebelumnya

                if (data.items && data.items.length > 0) {
                    data.items.forEach(item => {
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
                } else {
                    $('#modalItemsTableBody').html('<tr><td colspan="5" class="text-center">Tidak ada data barang.</td></tr>');
                }

                // Tampilkan modal setelah data dimuat
                $('#viewItemsModal').modal('show');
            })
            .catch(error => {
                console.error('Gagal memuat data:', error);
                alert('Gagal memuat data.');
            });
    });
});
</script>
@endsection
