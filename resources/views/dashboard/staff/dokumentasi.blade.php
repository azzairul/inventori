@extends('dashboard.staff.components.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    /* Gaya Umum untuk Card */
    .card.event-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 2px solid transparent;
        border-radius: 10px;
        padding: 20px;
        background-color: #fff;
    }

    .card.event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        border-color: #4e73df;
    }

    /* Ikon pada Judul Kartu */
    .card-title i {
        font-size: 1.3rem;
        color: #6c757d;
    }

    /* Teks Tanggal pada Kartu */
    .card-text small i {
        color: #adb5bd;
    }

    /* Tombol Lihat Foto */
    .btn-outline-primary {
        border-color: #0d6efd;
        color: #0d6efd;
        text-transform: uppercase;
        font-weight: bold;
        transition: all 0.3s;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    /* Styling for modal */
    .modal-header {
        background-color: #28a745;
        color: white;
        border-bottom: 2px solid #fff;
    }

    .modal-content {
        border-radius: 10px;
    }

    .event-card .card-body {
        background-color: #f8f9fa;
    }

    /* Styling for search and filter area */
    #searchInput, #filterCategory {
        border-radius: 25px;
        padding: 10px;
        border: 1px solid #ccc;
    }

    #searchInput:focus, #filterCategory:focus {
        outline: none;
        border-color: #0d6efd;
    }

    .filter-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #28a745;
        color: white;
        border-radius: 10px 10px 0 0;
    }

    .card-body {
        padding-top: 0;
    }
</style>

<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Kelola Dokumentasi Kegiatan</h5>
            <div class="filter-container">
                <input type="text" id="searchInput" class="form-control me-2" placeholder="Cari Nama Kegiatan" aria-label="Search">
                <select id="filterCategory" class="form-select me-2" aria-label="Filter by category">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-body">
            <div id="categoriesContainer">
                @foreach ($categories as $category)
                <h5 class="mt-4">
                    <i class="fa-solid fa-folder-open text-muted me-2"></i> {{ $category->name }}
                </h5>
                <div class="row">
                    @foreach ($category->events as $event)
                    <div class="col-md-4">
                        <div class="card event-card mb-4" data-category="{{ $category->name }}" data-name="{{ $event->eventName }}">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fa-solid fa-calendar-day text-muted me-2"></i> {{ $event->eventName }}
                                </h5>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fa-regular fa-clock me-1"></i>{{ $event->eventDate }}
                                    </small><br>
                                    {{ Str::limit($event->eventDescription, 100) }}
                                </p>
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewGalleryModal" data-id="{{ $event->id }}">
                                    <i class="fa-solid fa-image me-1"></i> Lihat Semua Foto
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>

        <!-- Modal View Gallery -->
        <div class="modal fade" id="viewGalleryModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Galeri Dokumentasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div id="galleryContent" class="row">
                            <p class="text-center">Memuat galeri...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const filterCategory = document.getElementById('filterCategory');
        const categoriesContainer = document.getElementById('categoriesContainer');

        function filterEvents() {
            const searchValue = searchInput.value.toLowerCase();
            const selectedCategory = filterCategory.value.toLowerCase();

            const eventCards = categoriesContainer.querySelectorAll('.event-card');

            eventCards.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                const category = card.getAttribute('data-category').toLowerCase();

                const isNameMatch = name.includes(searchValue);
                const isCategoryMatch = selectedCategory ? category === selectedCategory : true;

                card.style.display = isNameMatch && isCategoryMatch ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterEvents);
        filterCategory.addEventListener('change', filterEvents);

        const galleryModal = document.getElementById('viewGalleryModal');
        galleryModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const eventId = button.getAttribute('data-id');

            fetch(`/staff/events/${eventId}/gallery`)
                .then(response => response.json())
                .then(data => {
                    const galleryContent = document.getElementById('galleryContent');
                    galleryContent.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(image => {
                            const imageCol = document.createElement('div');
                            imageCol.classList.add('col-md-3', 'mb-3');

                            const imageCard = document.createElement('div');
                            imageCard.classList.add('card');

                            const imageElement = document.createElement('img');
                            imageElement.src = image.url;
                            imageElement.alt = image.alt || 'Gambar Galeri';
                            imageElement.classList.add('card-img-top', 'img-fluid', 'rounded');

                            const downloadButton = document.createElement('a');
                            downloadButton.href = image.url;
                            downloadButton.download = true;
                            downloadButton.classList.add('btn', 'btn-secondary', 'btn-sm', 'mt-2');
                            downloadButton.textContent = 'Unduh';

                            const cardBody = document.createElement('div');
                            cardBody.classList.add('card-body');
                            cardBody.appendChild(downloadButton);

                            imageCard.appendChild(imageElement);
                            imageCard.appendChild(cardBody);
                            imageCol.appendChild(imageCard);

                            galleryContent.appendChild(imageCol);
                        });
                    } else {
                        galleryContent.innerHTML = '<p class="text-center text-muted">Tidak ada gambar yang tersedia.</p>';
                    }
                })
                .catch(() => {
                    document.getElementById('galleryContent').innerHTML = '<p class="text-danger">Gagal memuat galeri.</p>';
                });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
