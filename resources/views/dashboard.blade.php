@extends('layout.main')

@section('content')
<h4 class="fw-bold mb-4">Beranda</h4>

<div class="d-flex justify-content-between mb-3" style="gap: 1rem;">
    <div class="card card-info p-3 flex-fill">
        <p class="text-muted mb-1">Jam Masuk Hari Ini</p>
        <h5 class="fw-bold">08:50:25</h5>
    </div>
    <div class="card card-info p-3 flex-fill">
        <p class="text-muted mb-1">Status Hari Ini</p>
        <h5 class="fw-bold text-success">Hadir</h5>
    </div>
</div>
@endsection
