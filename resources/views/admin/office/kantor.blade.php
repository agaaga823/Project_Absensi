@extends('admin.main')

@section('content')
<div class="container-fluid px-4">
    <h4 class="fw-bold mb-4">Lokasi Kantor</h4>

    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-end mb-3">
        <a href = "{{ route('admin.office.create') }}" class="btn btn-danger">Tambah Lokasi</a> {{-- Ganti href sesuai route --}}
    </div>

    <!-- Tabel Lokasi -->
    <div class="table-responsive">
        <table class="table table-bordered rounded overflow-hidden" style="border-radius: 8px;">
            <thead style="background-color: #dbe8f7;">
                <tr>
                    <th>Nama</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Radius</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kantor Utama</td>
                    <td>-5.987654</td>
                    <td>105.97374687436</td>
                    <td>200</td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Tombol Edit -->
                            <button 
                                class="btn btn-sm d-flex align-items-center justify-content-center" 
                                style="background-color: #f0f0f0; width: 35px; height: 35px;" 
                                title="Edit Lokasi"
                            >
                                <i class="bi bi-pencil-fill text-dark"></i>
                            </button>

                            <!-- Tombol Hapus -->
                            <button 
                                class="btn btn-sm d-flex align-items-center justify-content-center" 
                                style="background-color: #f0f0f0; width: 35px; height: 35px;" 
                                title="Hapus Lokasi"
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
