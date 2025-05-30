@extends('admin.main')

@section('content')
<h4 class="fw-bold mb-4">Beranda</h4>

<div class="row mb-3">
    <div class="col-md-6">
        <div class="card card-info p-3">
            <p class="text-muted mb-1">Total Pengguna</p>
            <h5 class="fw-bold">{{ $totalUsers }}</h5>
        </div>
    </div>
</div>
@endsection
