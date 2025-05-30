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
                    <th>Nama Kantor</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Radius</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kantors as $kantor)
                <tr>
                    <td>{{ $kantor->nama }}</td>
                    <td>{{ $kantor->latitude }}</td>
                    <td>{{ $kantor->longitude }}</td>
                    <td>{{ $kantor->radius }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.office.edit', $kantor->id) }}" 
                               class="btn btn-sm d-flex align-items-center justify-content-center" 
                               style="background-color: #f0f0f0; width: 35px; height: 35px;" 
                               title="Edit Lokasi">
                                <i class="bi bi-pencil-fill text-dark"></i>
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.office.destroy', $kantor->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lokasi ini?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm d-flex align-items-center justify-content-center" 
                                        style="background-color: #f0f0f0; width: 35px; height: 35px;" 
                                        title="Hapus Lokasi">
                                    <i class="bi bi-trash-fill text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection
