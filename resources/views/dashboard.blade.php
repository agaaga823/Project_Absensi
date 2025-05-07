@extends('layout.main')

@section('content')
<h4 class="fw-bold mb-4">Beranda</h4>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card card-info p-3">
            <p class="text-muted mb-1">Jam Masuk Hari Ini</p>
            <h5 class="fw-bold">08:50:25</h5>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-info p-3">
            <p class="text-muted mb-1">Status Hari Ini</p>
            <h5 class="fw-bold text-success">Hadir</h5>
        </div>
    </div>
</div>
@endsection