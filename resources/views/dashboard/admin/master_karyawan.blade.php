@extends('dashboard.admin.components.master')
<link rel="stylesheet" href="style5.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Data Master Karyawan :</h1>

    <div class="card shadow p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Status</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Nomor urut -->
                            <td>{{ $employee->nama ?? 'Tidak tersedia' }}</td>
                            <td>{{ $employee->nik ?? 'Tidak tersedia' }}</td>
                            <td>{{ ucfirst($employee->jenis_kelamin ?? 'Tidak tersedia') }}</td>
                            <td>{{ $employee->tempat_lahir ?? 'Tidak tersedia' }}</td>
                            <td>{{ $employee->tanggal_lahir ?? 'Tidak tersedia' }}</td>
                            <td>{{ ucfirst($employee->status ?? 'Tidak tersedia') }}</td>
                            <td>{{ $employee->alamat ?? 'Tidak tersedia' }}</td>
                            <td>
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fa-solid fa-trash-can"></i>
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
@endsection
