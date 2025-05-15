@extends('layout.main')

@section('content')
<h4 class="fw-bold mb-4">Presensi</h4>

<div class="d-flex justify-content-end mb-3">
    <a href = "{{ route('presensi.create') }}" class="btn btn-danger">Tambah Presensi</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2025-04-20</td>
                <td>Agnes</td>
                <td>08:50:25</td>
                <td>17:20:11</td>
                <td class="text-success fw-bold">Hadir</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
