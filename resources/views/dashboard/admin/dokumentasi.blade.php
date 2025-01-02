@extends('dashboard.admin.components.master')

@section('content')
<!-- Include Bootstrap and Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    body {
        background-color: #fafafa;
        font-family: 'Roboto', sans-serif;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .card-header {
        background-color: #007bff;
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .table th {
        background-color: #007bff;
        color: white;
        text-align: center;
    }

    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table-actions button {
        border-radius: 8px;
        padding: 6px 12px;
        margin: 0 5px;
    }

    .modal-header {
        background-color: #007bff;
        color: white;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .modal-footer .btn {
        border-radius: 50px;
        padding: 10px 20px;
    }

    .form-control, .form-select, .btn {
        border-radius: 8px;
    }

    .search-filter {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .search-filter input,
    .search-filter select {
        width: 250px;
    }

    .modal-content {
        border-radius: 12px;
    }

    .card-body {
        padding: 30px;
    }

    .btn-primary {
        background-color: #0069d9;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .search-filter button {
        padding: 10px 20px;
        font-size: 1rem;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-item img {
        width: 100%;
        height: auto;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    .gallery-item img:hover {
        transform: scale(1.1);
    }

    .gallery-item .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay i {
        font-size: 2rem;
        color: white;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay i {
        transform: scale(1.2);
    }
</style>

<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Kelola Dokumentasi</h5>
            <div class="search-filter">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Kegiatan">
                <select id="filterCategory" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentationModal">
                    <i class="fa-solid fa-circle-plus"></i> Tambah Dokumentasi
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="documentationTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Galeri</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentations as $index => $doc)
                        <tr data-category="{{ $doc->category->name }}">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $doc->eventName }}</td>
                            <td>{{ $doc->category->name }}</td>
                            <td>{{ $doc->eventDate }}</td>
                            <td>{{ Str::limit($doc->eventDescription, 50) }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewGalleryModal" data-id="{{ $doc->id }}">
                                    <i class="fa-solid fa-image"></i> Galeri
                                </button>
                            </td>
                            <td class="table-actions">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editDocumentationModal" data-id="{{ $doc->id }}" data-name="{{ $doc->eventName }}" data-category="{{ $doc->category->id }}" data-date="{{ $doc->eventDate }}" data-description="{{ $doc->eventDescription }}">
                                    <i class="fa-solid fa-pencil-alt"></i> Edit
                                </button>
                                <form action="{{ route('admin.documentations.destroy', $doc->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Dokumentasi -->
<div class="modal fade" id="addDocumentationModal" tabindex="-1" aria-labelledby="addDocumentationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDocumentationModalLabel">Tambah Dokumentasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.documentations.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="eventName">Nama Kegiatan</label>
                        <input type="text" name="eventName" id="eventName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate">Tanggal</label>
                        <input type="date" name="eventDate" id="eventDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventPhotos">Foto</label>
                        <input type="file" name="eventPhotos[]" id="eventPhotos" class="form-control" multiple accept="image/*" required>
                        <small class="text-muted">Unggah hingga maksimal 200 foto sekaligus.</small>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription">Deskripsi</label>
                        <textarea name="eventDescription" id="eventDescription" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-arrow-left"></i> Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Dokumentasi -->
<div class="modal fade" id="editDocumentationModal" tabindex="-1" aria-labelledby="editDocumentationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDocumentationModalLabel">Edit Dokumentasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label for="editName">Nama Kegiatan</label>
                        <input type="text" name="eventName" id="editName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCategory">Kategori</label>
                        <select name="category_id" id="editCategory" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDate">Tanggal</label>
                        <input type="date" name="eventDate" id="editDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription">Deskripsi</label>
                        <textarea name="eventDescription" id="editDescription" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editPhotos">Foto</label>
                        <input type="file" name="eventPhotos[]" id="editPhotos" class="form-control" multiple accept="image/*">
                        <small class="text-muted">Jika ada foto tambahan, silakan unggah di sini.</small>
                    </div>
                    <!-- Foto yang sudah ada -->
                    <div class="mb-3" id="existingPhotos"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check-circle"></i> Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-arrow-left"></i> Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lihat Galeri -->
<div class="modal fade" id="viewGalleryModal" tabindex="-1" aria-labelledby="viewGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewGalleryModalLabel">Galeri Dokumentasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="galleryImages"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-arrow-left"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap and JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const filterCategory = document.getElementById('filterCategory');
        const documentationTable = document.getElementById('documentationTable');
        
        // Filter Tabel
        function filterTable() {
            const searchValue = searchInput.value.toLowerCase();
            const selectedCategory = filterCategory.value.toLowerCase();
            const rows = documentationTable.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const eventName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const category = row.getAttribute('data-category').toLowerCase();
                
                const isNameMatch = eventName.includes(searchValue);
                const isCategoryMatch = selectedCategory ? category.includes(selectedCategory) : true;
                
                if (isNameMatch && isCategoryMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterTable);
        filterCategory.addEventListener('change', filterTable);

        // Edit Modal
        const editModal = document.getElementById('editDocumentationModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const category = button.getAttribute('data-category');
            const date = button.getAttribute('data-date');
            const description = button.getAttribute('data-description');

            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editCategory').value = category;
            document.getElementById('editDate').value = date;
            document.getElementById('editDescription').value = description;

            const editForm = document.getElementById('editForm');
            editForm.action = `/admin/documentations/${id}`;
        });

        // View Gallery Modal
        const viewGalleryModal = document.getElementById('viewGalleryModal');
        viewGalleryModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const docId = button.getAttribute('data-id');
            
            const galleryImagesContainer = document.getElementById('galleryImages');
            galleryImagesContainer.innerHTML = '';  
            
            fetch(`/admin/documentations/${docId}/gallery`)
                .then(response => response.json())
                .then(data => {
                    if (data.images && data.images.length > 0) {
                        data.images.forEach(image => {
                            const imgElement = document.createElement('div');
                            imgElement.classList.add('col-4', 'mb-3');
                            imgElement.innerHTML = `<img src="${image.url}" class="img-fluid" alt="Image" style="max-height: 200px; object-fit: cover;">`;
                            galleryImagesContainer.appendChild(imgElement);
                        });
                    } else {
                        galleryImagesContainer.innerHTML = '<p>Tidak ada gambar untuk dokumentasi ini.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching gallery images:', error);
                });
        });
    });
</script>

@endsection
