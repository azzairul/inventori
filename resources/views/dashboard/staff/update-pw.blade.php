@extends ('dashboard.staff.components.master')

@section('content')
<style>
    /* Reset default margin and padding */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fc;
        color: #333;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 2em;
        color: #4e73df;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        color: #4e73df;
        margin-bottom: 5px;
        display: block;
    }

    input[type="password"], input[type="email"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0 15px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1em;
    }

    .btn {
        padding: 10px 20px;
        font-size: 1em;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: inline-block;
        text-align: center;
        border: none;
    }

    .btn-primary {
        background-color: #4e73df;
        color: white;
    }

    .btn-primary:hover {
        background-color: #3b5ab7;
    }

    .btn-secondary {
        background-color: #f0f0f0;
        color: #333;
        border: 1px solid #ddd;
    }

    .btn-secondary:hover {
        background-color: #e0e0e0;
    }

    .btn-secondary.ms-2 {
        margin-left: 10px;
    }

    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-top: 20px;
        font-size: 1em;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
            margin: 20px;
        }

        h1 {
            font-size: 1.8em;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .btn {
            width: 100%;
            margin-top: 10px;
        }

        .btn-secondary.ms-2 {
            margin-left: 0;
            margin-top: 10px;
        }
    }
</style>

<link rel="stylesheet" href="dashboard/Update-Pw.css">
<div class="container">
    <h1>Manajemen Akun</h1>
    <p>Nama: {{ $staff->name }}</p>
    <p>Email: {{ $staff->email }}</p>

    <!-- Form untuk ubah password -->
    <form action="{{ route('staff.changePassword') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="current_password">Password Sekarang</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required value ="{{ Auth::user()->password }}">
        </div>

        <div class="form-group">
            <label for="new_password">Password Baru</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary ms-2" onclick="window.history.back();">Batal</button>
    </form>

    <!-- Notifikasi -->
    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
</div>
@endsection
