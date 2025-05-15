@extends('admin.main')

@section('content')
<div class="container-fluid px-4">
    <h4 class="fw-bold mb-4">Tambah Pengguna</h4>

    <div class="card p-4">
        <form action="{{ route('admin.user.create') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name') }}" 
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    value="{{ old('email') }}" 
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label fw-semibold">Posisi / Role</label>
                <select 
                    id="role" 
                    name="role" 
                    class="form-select @error('role') is-invalid @enderror" 
                    required
                >
                    <option value="" disabled selected>Pilih Posisi</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                    <!-- Tambah opsi lain sesuai kebutuhan -->
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.user.create') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
