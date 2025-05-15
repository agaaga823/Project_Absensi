@extends('admin.main')

@section('content')
<div class="container-fluid px-4">
    <h4 class="fw-bold mb-4">Pengguna</h4>

    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-end mb-3">
        <a href = "{{ route('admin.user.create') }}" class="btn btn-danger">Tambah Pengguna</a> {{-- Ganti href sesuai route --}}
    </div>

    <!-- Tabel Pengguna -->
    <div class="table-responsive">
        <table class="table table-bordered rounded overflow-hidden" style="border-radius: 8px;">
            <thead style="background-color: #dbe8f7;">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Posisi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Admin</td>
                    <td>adm@gmail.com</td>
                    <td>Admin</td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Tombol Edit -->
                            <button 
                                class="btn btn-sm d-flex align-items-center justify-content-center" 
                                style="background-color: #f0f0f0; width: 35px; height: 35px;" 
                                title="Edit Pengguna"
                            >
                                <i class="bi bi-pencil-fill text-dark"></i>
                            </button>

                            <!-- Tombol Hapus -->
                            <button 
                                class="btn btn-sm d-flex align-items-center justify-content-center" 
                                style="background-color: #f0f0f0; width: 35px; height: 35px;" 
                                title="Hapus Pengguna"
                            >
                                <i class="bi bi-trash-fill text-danger"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Agnes</td>
                    <td>agnes12@gmail.com</td>
                    <td>Karyawan</td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Tombol Edit -->
                            <button 
                                class="btn btn-sm d-flex align-items-center justify-content-center" 
                                style="background-color: #f0f0f0; width: 35px; height: 35px;" 
                                title="Edit Pengguna"
                            >
                                <i class="bi bi-pencil-fill text-dark"></i>
                            </button>

                            <!-- Tombol Hapus -->
                            <button 
                                class="btn btn-sm d-flex align-items-center justify-content-center" 
                                style="background-color: #f0f0f0; width: 35px; height: 35px;" 
                                title="Hapus Pengguna"
                            >
                                <i class="bi bi-trash-fill text-danger"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection
