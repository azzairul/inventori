<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: rgb(78, 115, 223);
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        .btn-primary {
            background-color: rgb(78, 115, 223);
            border: none;
        }
        .btn-primary:hover {
            background-color: #3a70c2;
        }
        .form-control {
            border-radius: 5px;
        }
        .text-primary {
            color: rgb(78, 115, 223) !important;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="text-center mb-4 text-primary">Selamat Datang Kembali</h3>
                    <p class="text-center text-muted mb-4">Login untuk melanjutkan</p>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label text-muted">Alamat Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="Masukkan email Anda">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-muted">Kata Sandi</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan kata sandi Anda">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ingat">
                                <label class="form-check-label text-muted" for="ingat">Ingat Saya</label>
                            </div>
                            <a href="#" class="text-muted" style="text-decoration: none;">Lupa Kata Sandi?</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
