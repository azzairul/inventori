@extends('dashboard.staff.components.master')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- FontAwesome CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@section('content')
<div class="container mt-5">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Manajemen Peminjaman</h1>
    </div>
    <div class="container mt-5">
        <!-- Info Transaksi Peminjaman -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Transaksi Peminjaman</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="transactionTable" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Transaksi</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Jam</th>
                                <th>Nama Peminjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $peminjaman->no_transaksi }}</td>
                                <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($peminjaman->jam_peminjaman)->format('H:i') }}</td>
                                <td>{{ $peminjaman->nama_peminjam }}</td>
                            </tr>
                        </tbody>                        
                    </table>
                </div>
            </div>
        </div>

    <!-- Modal Alasan Peminjaman -->
<div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="reasonForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="reasonModalLabel">Alasan Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="loanReason">Tuliskan alasan peminjaman:</label>
                        <textarea class="form-control" id="loanReason" name="loanReason" rows="3" placeholder="Masukkan alasan peminjaman..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="borrowForm">
                <div class="form-row align-items-end">
                    <div class="form-group col-md-3">
                        <label for="kodeBarang">Kode Barang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="kodeBarang" name="kodeBarang" readonly>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info" id="selectItemButton" data-toggle="modal" data-target="#selectItemModal">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button type="button" class="btn btn-danger" id="deleteItemButton">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group col-md-3">
                        <label for="namaBarang">Nama Barang</label>
                        <input type="text" class="form-control" id="namaBarang" name="namaBarang" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="kategoriBarang">Kategori</label>
                        <input type="text" class="form-control" id="kategoriBarang" name="kategoriBarang" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="lokasiBarang">Lokasi Penyimpanan</label>
                        <input type="text" class="form-control" id="lokasiBarang" name="lokasiBarang" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="jumlahBarang">Jumlah</label>
                        <input type="number" class="form-control" id="jumlahBarang" name="jumlahBarang" min="1">
                    </div>
                    <div class="form-group col-md-2 d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" id="addItem">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                        <button type="button" class="btn btn-warning" id="resetForm">
                            <i class="fas fa-redo"></i> Ulang
                        </button>
                        <button type="button" class="btn btn-success" id="borrowItems">
                            <i class="fas fa-arrow-right"></i> Pinjam
                        </button>
                    </div>                                                                                                 
                </div>
            </form>
        </div>
    </div>

    <!-- Peminjaman Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Barang Dipinjam</h6>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <table id="borrowTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Lokasi Penyimpanan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Baris data akan ditambahkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</div>

<!-- Select Item Modal -->
<!-- Select Item Modal -->
<div class="modal fade" id="selectItemModal" tabindex="-1" aria-labelledby="selectItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectItemModalLabel">Pilih Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="itemSelectionTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Lokasi Penyimpanan</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>
                                <button class="btn btn-sm btn-info selectItem" 
                                        data-kode="{{ $item->kode_barang }}" 
                                        data-nama="{{ $item->nama_barang }}" 
                                        data-kategori="{{ $item->category->nama }}" 
                                        data-lokasi="{{ $item->lokasi }}">
                                    <i class="fas fa-check"></i> Pilih
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    // Event listener untuk tombol 'Pilih' di modal
    $('.selectItem').on('click', function() {
        // Ambil data dari tombol
        const kode = $(this).data('kode');
        const nama = $(this).data('nama');
        const kategori = $(this).data('kategori');
        const lokasi = $(this).data('lokasi');

        // Masukkan data ke dalam form
        $('#kodeBarang').val(kode);
        $('#namaBarang').val(nama);
        $('#kategoriBarang').val(kategori);
        $('#lokasiBarang').val(lokasi);

        // Tutup modal
        $('#selectItemModal').modal('hide');
        $('.modal-backdrop').remove();
    });

    // Tombol reset untuk mengosongkan form
    $('#resetForm').on('click', function() {
        $('#kodeBarang').val('');
        $('#namaBarang').val('');
        $('#kategoriBarang').val('');
        $('#lokasiBarang').val('');
        $('#jumlahBarang').val('');
    });

    // Tombol hapus data barang yang dipilih
    $('#deleteItemButton').on('click', function() {
        $('#kodeBarang').val('');
        $('#namaBarang').val('');
        $('#kategoriBarang').val('');
        $('#lokasiBarang').val('');
    });
});
</script>
<script>
    $(document).ready(function () {
    let itemCount = 0; // Counter untuk nomor urut

    // Event listener tombol tambah
    $('#addItem').on('click', function () {
        // Ambil data dari form
        const kodeBarang = $('#kodeBarang').val();
        const namaBarang = $('#namaBarang').val();
        const kategoriBarang = $('#kategoriBarang').val();
        const lokasiBarang = $('#lokasiBarang').val();
        const jumlahBarang = $('#jumlahBarang').val();

        // Validasi data
        if (!kodeBarang || !namaBarang || !kategoriBarang || !lokasiBarang || !jumlahBarang) {
            alert('Semua field harus diisi!');
            return;
        }

        // Increment item count
        itemCount++;

        // Tambahkan data ke tabel
        const newRow = `
            <tr>
                <td>${itemCount}</td>
                <td>${kodeBarang}</td>
                <td>${namaBarang}</td>
                <td>${kategoriBarang}</td>
                <td>${lokasiBarang}</td>
                <td>${jumlahBarang}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm removeItem">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>
            </tr>
        `;
        $('#borrowTable tbody').append(newRow);

        // Reset form setelah tambah
        $('#kodeBarang').val('');
        $('#namaBarang').val('');
        $('#kategoriBarang').val('');
        $('#lokasiBarang').val('');
        $('#jumlahBarang').val('');
    });

    // Event listener tombol hapus di tabel
    $(document).on('click', '.removeItem', function () {
        $(this).closest('tr').remove();
        itemCount--;
        // Update nomor urut
        $('#borrowTable tbody tr').each(function (index) {
            $(this).find('td:first').text(index + 1);
        });
    });
});
</script>>
<script>
    $(document).ready(function () {
    // Event listener untuk tombol Pinjam
    $('#borrowItems').on('click', function () {
        // Periksa apakah ada barang di tabel
        if ($('#borrowTable tbody tr').length === 0) {
            alert('Tidak ada barang yang dipilih untuk dipinjam!');
            return;
        }

        // Tampilkan modal alasan peminjaman
        $('#reasonModal').modal('show');
    });

    // Form submission untuk alasan peminjaman
    $('#reasonForm').on('submit', function (e) {
        e.preventDefault(); // Mencegah reload halaman

        // Ambil data dari form alasan peminjaman
        const loanReason = $('#loanReason').val();

        // Validasi alasan
        if (!loanReason.trim()) {
            alert('Alasan peminjaman harus diisi!');
            return;
        }

        // Ambil data barang dari tabel
        const borrowedItems = [];
        $('#borrowTable tbody tr').each(function () {
            const row = $(this);
            borrowedItems.push({
                kode_barang: row.find('td:nth-child(2)').text(),
                jumlah: row.find('td:nth-child(6)').text(),
            });
        });

        // Kirim data ke server
        $.ajax({
            url: '/peminjaman/submit', // Endpoint untuk menyimpan peminjaman
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                alasan_peminjaman: loanReason,
                items: borrowedItems,
            },
            success: function (response) {
                alert('Peminjaman berhasil diajukan!');
                // Redirect atau reset form
                location.reload();
            },
            error: function (error) {
                console.error(error);
                alert('Terjadi kesalahan saat mengajukan peminjaman.');
            },
        });

        // Tutup modal
        $('#reasonModal').modal('hide');
    });
});

</script>
@endsection