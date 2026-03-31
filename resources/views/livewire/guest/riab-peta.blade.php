<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
    #riab-map { 
        height: 600px; 
        width: 100%; 
        border-radius: 0.5rem; 
        z-index: 10; 
    }
    .leaflet-container {
        font-family: inherit;
    }
</style>
<div wire:ignore class="w-full shadow-lg border border-gray-200 rounded-lg">
    <div id="riab-map"></div>
</div>
<!-- Memuat Javascript Leaflet -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Inisialisasi peta berpusat di koordinat Provinsi Bali
        var map = L.map('riab-map').setView([-8.409518, 115.188919], 9);
        // 2. Set Up Tampilan Peta Gratis dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        // 3. Menarik Data Lokasi dari Livewire Component JSON
        var houses = @json($locations);
        // 4. Looping / Iterasi memasukkan tiap marker ke dalam peta
        houses.forEach(function(house) {
            if(house.lat && house.long) {
                var marker = L.marker([house.lat, house.long]).addTo(map);
                // Template HTML yang akan muncul saat di-Hover
                var tooltipHtml = `
                    <div style="min-width: 160px;">
                        <strong style="font-size: 14px; display: block; margin-bottom: 2px;">${house.nama}</strong>
                        <div style="font-size: 12px; color: #555; margin-bottom: 6px;">
                            ${house.alamat ? house.alamat : 'Alamat tidak tersedia'}
                        </div>
                        <span style="font-size: 11px; color: #2563eb; font-weight: bold;">
                            🖱️ Klik untuk detail
                        </span>
                    </div>
                `;
                // Memberikan Tooltip dengan tampilan khusus
                marker.bindTooltip(tooltipHtml, {
                    direction: 'top',
                    offset: [0, -35], // Menarik posisi tooltip keatas (tidak menutupi drop marker)
                    opacity: 0.95,
                    className: 'shadow-sm rounded'
                });
                // Action: Mengarahkan Pindah Halaman saat Titik/Marker diklik
                marker.on('click', function() {
                    window.location.href = house.url;
                });
            }
        });
    });
</script>