@extends('admin.main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-3">Lokasi Kantor</h5>
</div>

<form method="POST" action="{{ route('admin.office.store') }}">
    @csrf
    <div class="row">
        <!-- Form Utama -->
        <div class="col-md-8">
            <div class="card p-4 mb-3">
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Kantor</label>
                    <select id="nama" name="nama" class="form-select text-white @error('nama') is-invalid @enderror" style="background-color: #142D70;" required>
                        <option value="Kantor Utama" {{ old('nama', 'Kantor Utama') == 'Kantor Utama' ? 'selected' : '' }}>Kantor Utama</option>
                        <option value="Kantor Cabang" {{ old('nama') == 'Kantor Cabang' ? 'selected' : '' }}>Kantor Cabang</option>
                    </select>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Lokasi (Klik pada Peta)</label>
                    <div id="map" style="height: 300px;" class="rounded mb-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="latitude" class="form-label fw-semibold">Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="form-control text-white @error('latitude') is-invalid @enderror" style="background-color: #142D70;" value="{{ old('latitude', '-5.898764') }}" required />
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="longitude" class="form-label fw-semibold">Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="form-control text-white @error('longitude') is-invalid @enderror" style="background-color: #142D70;" value="{{ old('longitude', '105.892765') }}" required />
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- Radius -->
        <div class="col-md-4">
            <div class="card p-3 mb-3">
                <label for="radius" class="form-label fw-semibold">Radius (meter)</label>
                <input type="text" id="radius" name="radius" class="form-control text-white @error('radius') is-invalid @enderror" style="background-color: #142D70;" value="{{ old('radius', '200') }}" required />
                @error('radius')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex gap-2 mb-3">
        <button type="submit" class="btn text-white" style="background-color: #fbb03b;">Simpan</button>
        <a href="{{ route('admin.kantor') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>

<!-- Leaflet CSS & JS sudah ada di main layout -->

<script>
    const latitudeInput = document.getElementById("latitude");
    const longitudeInput = document.getElementById("longitude");

    const defaultLat = parseFloat(latitudeInput.value) || -5.898764;
    const defaultLng = parseFloat(longitudeInput.value) || 105.892765;

    let map = L.map('map').setView([defaultLat, defaultLng], 13);
    let marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    // Tambah tile dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Update input ketika marker digeser
    marker.on('dragend', function (e) {
        const position = marker.getLatLng();
        latitudeInput.value = position.lat.toFixed(6);
        longitudeInput.value = position.lng.toFixed(6);
    });

    // Klik di peta juga bisa pindah marker
    map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        latitudeInput.value = e.latlng.lat.toFixed(6);
        longitudeInput.value = e.latlng.lng.toFixed(6);
    });

    // Update marker ketika input manual diubah
    function updateMarkerFromInputs() {
        const lat = parseFloat(latitudeInput.value);
        const lng = parseFloat(longitudeInput.value);

        if (!isNaN(lat) && !isNaN(lng)) {
            const newLatLng = L.latLng(lat, lng);
            marker.setLatLng(newLatLng);
            map.setView(newLatLng);
        }
    }

    latitudeInput.addEventListener("input", updateMarkerFromInputs);
    longitudeInput.addEventListener("input", updateMarkerFromInputs);
</script>
@endsection
