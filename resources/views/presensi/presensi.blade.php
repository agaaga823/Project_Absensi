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
            @forelse ($presensis as $presensi)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($presensi->tanggal_presensi)->translatedFormat('d F Y') }}</td>
                    <td>{{ $presensi->user->nama ?? 'N/A' }}</td>
                    <td>{{ $presensi->jam_masuk }}</td>
                    <td>{{ $presensi->jam_keluar ?? '- - : - - : - -' }}</td>
                    <td class="{{ ($presensi->jam_masuk && $presensi->jam_keluar) ? 'text-success' : 'text-warning' }} fw-bold">
                        @if ($presensi->jam_masuk && $presensi->jam_keluar)
                            Hadir
                        @else
                            Belum Lengkap
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data presensi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
