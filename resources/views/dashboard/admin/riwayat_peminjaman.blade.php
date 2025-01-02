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

<div class="container mt-5">
    <!-- Tabel Riwayat Peminjaman Barang -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold">
                <i class="fas fa-clipboard-list me-2"></i>Riwayat Peminjaman Barang Admin
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ url('/admin-dashboard/riwayat-peminjaman') }}" class="row g-3 mb-3" id="sortForm">
                <!-- Pilihan Sort -->
                <div class="col-md-6 col-lg-4">
                    <label for="order" class="form-label fw-semibold text-primary">Urutkan Berdasarkan</label>
                    <select name="order" id="order" class="form-select shadow-sm">
                        <option value="desc" {{ $order == 'desc' ? 'selected' : '' }}>Terbaru</option>
                        <option value="asc" {{ $order == 'asc' ? 'selected' : '' }}>Terlama</option>
                        <option value="ACC" {{ $order == 'ACC' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Tolak" {{ $order == 'Tolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <!-- Search Bar -->
                <div class="col-md-6 col-lg-4">
                    <label for="search" class="form-label fw-semibold text-primary">Cari Transaksi</label>
                    <input type="text" class="form-control shadow-sm" id="search" placeholder="Cari">
                </div>
            </form> <!-- Close the form here -->

            <!-- Data Table -->
            <div class="table-responsive">
                <table id="adminReportTable" class="table table-hover align-middle">
                    <thead class="bg-primary text-white text-center">
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
                        @forelse($returns as $index => $return)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $return->no_transaksi }}</td>
                            <td>{{ $return->tanggal_peminjaman }}</td>
                            <td>{{ $return->tanggal_pengembalian }}</td>
                            <td>{{ $return->jam_peminjaman }}</td>
                            <td>{{ $return->nama_peminjam }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary viewItems shadow-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#viewItemsModal"
                                        data-items="{{ json_encode($return->items ?? []) }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger deleteTransaction shadow-sm" 
                                        data-id="{{ $return->id }}"
                                        title="Hapus Transaksi">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data peminjaman.</td>
                        </tr>
                        @endforelse
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
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewItemsModalLabel">
                    <i class="fas fa-box-open me-2"></i>Detail Barang Peminjaman
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-light text-primary">
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- CSS Kustom -->
<style>
    .bg-primary { background-color: #4e73df !important; }
    .text-primary { color: #4e73df !important; }
    .btn-primary { background-color: #4e73df; border-color: #4e73df; }
    .btn-outline-primary { color: #4e73df; border-color: #4e73df; }
    .btn-outline-primary:hover { background-color: #4e73df; color: #fff; }
    .btn-outline-danger:hover { background-color: #d9534f; color: #fff; }
    table thead { border-top: 2px solid #4e73df; }
    .btn-sm { font-size: 0.85rem; padding: 0.4rem 0.6rem; border-radius: 0.3rem; }
</style>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        var table = $('#adminReportTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' }
        });

        // Detect changes in the order dropdown
        $('#order').on('change', function () {
            // Get the selected order value
            var order = $(this).val();

            // Trigger the form submission to reload the table with the selected filter
            window.location.href = '{{ url('/admin-dashboard/riwayat-peminjaman') }}?order=' + order;
        });

        // Search Bar functionality
        $('#search').on('keyup', function () {
            table.search(this.value).draw();
        });

        // View Items Modal
        $('.viewItems').on('click', function () {
            const items = $(this).data('items') || [];
            const tableBody = $('#modalItemsTableBody').empty();

            if (items.length === 0) {
                tableBody.html('<tr><td colspan="5" class="text-center text-muted">Tidak ada barang yang dipinjam.</td></tr>');
                return;
            }

            items.forEach(item => {
                tableBody.append(`
                    <tr>
                        <td>${item.kode_barang || '-'}</td>
                        <td>${item.nama_barang || '-'}</td>
                        <td>${item.kategori || '-'}</td>
                        <td>${item.lokasi || '-'}</td>
                        <td>${item.jumlah || '-'}</td>
                    </tr>
                `);
            });
        });

        // Delete Transaction
        $('.deleteTransaction').on('click', function () {
            const transactionId = $(this).data('id');
            if (confirm('Are you sure you want to delete this transaction?')) {
                $.ajax({
                    url: `/admin-dashboard/riwayat-peminjaman/${transactionId}`,
                    method: 'DELETE',
                    success: function(response) {
                        // Reload the page or remove the row from the table
                        location.reload();
                    },
                    error: function(error) {
                        alert('Error deleting transaction');
                    }
                });
            }
        });

        // Initialize Tooltips
        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    });
</script>
@endsection
