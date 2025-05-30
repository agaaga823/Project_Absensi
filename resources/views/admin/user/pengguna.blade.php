@extends('admin.main')

@section('content')
<div class="container-fluid px-4">
    <h4 class="fw-bold mb-4">Pengguna</h4>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.user.create') }}" class="btn btn-danger">Tambah Pengguna</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered rounded overflow-hidden">
            <thead style="background-color: #dbe8f7;">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Posisi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm" style="background-color: #f0f0f0;">
                                <i class="bi bi-pencil-fill text-dark"></i>
                            </a>
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm" style="background-color: #f0f0f0;">
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
@endsection
