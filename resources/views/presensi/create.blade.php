@extends('layout.main')

@section('content')
<div class="container">
    <div class="card shadow-sm rounded-4 p-4" style="max-width: 500px; margin: auto;">
        <h5 class="fw-bold mb-3">Informasi Pegawai</h5>

        <div class="bg-light rounded-3 p-3 mb-3">
            <p class="mb-1"><strong>Nama :</strong> {{ Auth::user()->nama ?? 'User' }} </p>
            <p class="mb-1"><strong>Jam Kerja :</strong> 09.00 - 17.00</p>
            <p class="mb-0"><strong>Kantor :</strong> Kantor Utama</p>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <div class="bg-light rounded-3 p-2 text-center" style="flex: 1; margin-right: 5px;">
                <strong>Jam Masuk</strong>
                <div id="displayJamMasuk">- - : - - : - -</div>
            </div>
            <div class="bg-light rounded-3 p-2 text-center" style="flex: 1; margin-left: 5px;">
                <strong>Jam Keluar</strong>
                <div id="displayJamKeluar">- - : - - : - -</div>
            </div>
        </div>

        <h6 class="fw-bold mb-2">Presensi</h6>

        <!-- PETA INTERAKTIF -->
        <div id="map" style="height: 250px;" class="rounded mb-3"></div>

        <div class="d-flex justify-content-between">
            <button id="lokasiBtn" class="btn btn-primary w-50 me-2">Klik Lokasi (Masuk)</button>
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

    // 0 = initial (belum klik), 1 = jam masuk sudah (tunggu jam keluar), 2 = jam keluar sudah (selesai)
    let presensiState = 0; 
    let jamMasukTime = null;
    let lokasiMasuk = null;
    let jamKeluarTime = null;
    let lokasiKeluar = null;


    // Tambahkan tile layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Fungsi untuk mendapatkan dan menampilkan lokasi
    function handleLokasiClick() {
        if (presensiState >= 2) {
            alert("Jam masuk dan keluar sudah direkam.");
            return;
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                const currentTime = new Date();
                const formattedTime = currentTime.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

                // Hapus marker dan circle lama jika ada
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
                
                if (presensiState === 0) { // Klik pertama untuk Jam Masuk
                    document.getElementById("displayJamMasuk").innerText = formattedTime;
                    jamMasukTime = currentTime;
                    lokasiMasuk = { latitude: lat, longitude: lon };
                    presensiState = 1;
                    document.getElementById("lokasiBtn").innerText = "Klik Lokasi (Keluar)";
                } else if (presensiState === 1) { // Klik kedua untuk Jam Keluar
                    document.getElementById("displayJamKeluar").innerText = formattedTime;
                    jamKeluarTime = currentTime;
                    lokasiKeluar = { latitude: lat, longitude: lon };
                    presensiState = 2;
                    document.getElementById("lokasiBtn").disabled = true;
                    document.getElementById("lokasiBtn").innerText = "Selesai";
                    document.getElementById("presensiBtn").disabled = false;
                }

            }, function(error) {
                console.error("Gagal mendapatkan lokasi: " + error.message);
                alert("Gagal mendapatkan lokasi. Pastikan Anda mengizinkan akses lokasi dan GPS aktif.");
            }, function(error) {
                console.error("Gagal mendapatkan lokasi: " + error.message);
                alert("Gagal mendapatkan lokasi. Pastikan Anda mengizinkan akses lokasi.");
            });
        } else {
            alert("Geolocation tidak didukung di browser ini.");
        }
    }

    // Tombol Klik Lokasi
    document.getElementById("lokasiBtn").addEventListener("click", function () {
        handleLokasiClick();
    });

    // URL tujuan setelah presensi berhasil
    const presensiIndexUrl = "{{ route('presensi.index') }}";

    // Tombol Kirim Presensi
document.getElementById("presensiBtn").addEventListener("click", function() {
    if (presensiState === 2 && jamMasukTime && lokasiMasuk && jamKeluarTime && lokasiKeluar) {
        const lokasiStringMasuk = lokasiMasuk.latitude + ',' + lokasiMasuk.longitude;
        const presensiData = {
            jam_masuk: jamMasukTime.toISOString(),
            jam_keluar: jamKeluarTime.toISOString(),
            lokasi: lokasiStringMasuk, // Kirim lokasi sebagai string
        };

        fetch("{{ route('presensi.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify(presensiData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message || "Presensi berhasil dikirim!");
                window.location.href = presensiIndexUrl;
            } else {
                let errorMessage = data.message || "Gagal mengirim presensi.";
                if (data.errors) {
                    errorMessage += "\n" + Object.values(data.errors).flat().join("\n");
                }
                alert(errorMessage);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Terjadi kesalahan saat mengirim presensi. Periksa konsol untuk detail.");
        });

    } else {
        alert("Harap lengkapi proses klik lokasi untuk jam masuk dan jam keluar terlebih dahulu.");
    }
});

</script>
@endsection
