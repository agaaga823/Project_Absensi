@extends('layout.main')

@section('content')
<div class="container">
    <div class="card shadow-sm rounded-4 p-4" style="max-width: 500px; margin: auto;">
        <h5 class="fw-bold mb-3">Informasi Pegawai</h5>

        <div class="bg-light rounded-3 p-3 mb-3">
            <p class="mb-1"><strong>Nama :</strong> Agnes</p>
            <p class="mb-1"><strong>Jam Kerja :</strong> 09.00 - 17.00</p>
            <p class="mb-0"><strong>Kantor :</strong> Kantor Utama</p>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <div class="bg-light rounded-3 p-2 text-center" style="flex: 1; margin-right: 5px;">
                <strong>Jam Masuk</strong>
                <div>{{ $jamMasuk }}</div>
            </div>
            <div class="bg-light rounded-3 p-2 text-center" style="flex: 1; margin-left: 5px;">
                <strong>Jam Keluar</strong>
                <div>{{ $jamKeluar }}</div>
            </div>
        </div>

        <h6 class="fw-bold mb-2">Presensi</h6>

        <!-- PETA INTERAKTIF -->
        <div id="map" style="height: 250px;" class="rounded mb-3"></div>

        <div class="d-flex justify-content-between">
            <button id="lokasiBtn" class="btn btn-primary w-50 me-2">Klik Lokasi</button>
            <button id="presensiBtn" class="btn btn-danger w-50 ms-2" disabled>Kirim Presensi</button>
        </div>
    </div>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    let map = L.map('map').setView([-2.5489, 118.0149], 5);
    let userMarker = null;
    let userCircle = null;
    let lokasiSiap = false;

    // Tambahkan tile layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Fungsi untuk mendapatkan dan menampilkan lokasi
    function locateUser() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;

                if (userMarker) map.removeLayer(userMarker);
                if (userCircle) map.removeLayer(userCircle);

                userMarker = L.marker([lat, lon]).addTo(map).bindPopup('Lokasi Anda').openPopup();
                userCircle = L.circle([lat, lon], {
                    color: 'red',
                    fillColor: '#FB2222',
                    fillOpacity: 0.3,
                    radius: 100
                }).addTo(map);

                map.setView([lat, lon], 16);

                lokasiSiap = true;
                document.getElementById("presensiBtn").disabled = false;

            }, function(error) {
                console.error("Gagal mendapatkan lokasi: " + error.message);
                alert("Gagal mendapatkan lokasi. Pastikan Anda mengizinkan akses lokasi.");
            });
        } else {
            alert("Geolocation tidak didukung di browser ini.");
        }
    }

    // Jalankan saat halaman dibuka pertama kali
    locateUser();

    // Tombol Klik Lokasi
    document.getElementById("lokasiBtn").addEventListener("click", function () {
        locateUser();
    });

    // URL tujuan setelah presensi berhasil
    const presensiIndexUrl = "{{ route('presensi.index') }}";

    // Tombol Kirim Presensi
    document.getElementById("presensiBtn").addEventListener("click", function () {
        if (lokasiSiap) {
            alert("Presensi berhasil dikirim!");
            window.location.href = presensiIndexUrl;
        } else {
            alert("Klik lokasi terlebih dahulu sebelum kirim presensi.");
        }
    });
</script>
@endsection
