<div class="flex flex-col md:flex-row w-full h-full bg-white">
    <!-- Leaflet Configuration -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #riab-map { height: 100%; width: 100%; z-index: 10; }
        .leaflet-container { font-family: inherit; }
        
        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar { width: 6px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: #f1f1f1; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }
    </style>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- SIDEBAR KIRI -->
    <div class="w-full md:w-[380px] lg:w-[420px] flex flex-col h-full shrink-0 border-r border-gray-200 z-20 shadow-lg relative bg-white">
        <!-- Header & Filters -->
        <div class="p-5 border-b border-gray-200 bg-white">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Eksplor Peta RIAB
            </h2>

            <div class="space-y-3">
                <!-- Dropdown Kota/Kabupaten -->
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Wilayah Kabupaten/Kota</label>
                    <div class="relative">
                        <select wire:model.live="kabupaten_id" class="w-full appearance-none bg-gray-50 border border-gray-300 text-gray-700 py-2.5 px-3 pr-8 rounded-lg outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all shadow-sm">
                            <option value="">Semua Wilayah Bali</option>
                            @foreach($kabupatens as $kab)
                                <option value="{{ $kab->id }}">{{ $kab->kabupaten }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Input Pencarian -->
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Cari Nama/Alamat</label>
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari..." class="w-full bg-gray-50 border border-gray-300 text-gray-700 py-2.5 pl-10 pr-3 rounded-lg outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 flex justify-between items-center text-xs text-gray-500">
                <span>Ditemukan <strong class="text-indigo-600 font-bold bg-indigo-50 px-2 py-0.5 rounded-full">{{ count($listRiab) }}</strong> lokasi</span>
            </div>
        </div>

        <!-- Daftar Scrollable Card -->
        <div class="flex-1 overflow-y-auto sidebar-scroll bg-gray-50/50 p-3 space-y-3">
            @forelse($listRiab as $riab)
                <div class="bg-white border text-left border-gray-200 rounded-lg p-4 hover:shadow-md hover:border-indigo-300 transition-all cursor-pointer group" 
                     onclick="focusMapMarker({{ $riab->id }}, {{ $riab->latitude ?: 'null' }}, {{ $riab->longitude ?: 'null' }})">
                    <div class="flex justify-between items-start">
                        <h3 class="font-bold text-gray-800 text-sm group-hover:text-indigo-600 transition-colors uppercase pr-2 line-clamp-2">
                            {{ $riab->nama }}
                        </h3>
                        <a href="{{ route('guest.riab.show', $riab->id) }}" target="_blank" class="text-gray-400 hover:text-indigo-600 shrink-0" title="Buka Profil" onclick="event.stopPropagation()">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                    
                    <div class="mt-2 space-y-1.5">
                        <div class="flex items-start text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 mr-1.5 mt-0.5 shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="font-medium text-gray-600">{{ $riab->kabupaten->kabupaten ?? 'Wilayah Tidak Diketahui' }}</span>
                        </div>
                        @if($riab->alamat)
                            <div class="text-xs text-gray-500 line-clamp-2 pl-5">{{ $riab->alamat }}</div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-10 px-4">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-gray-500 text-sm font-medium">Tidak ada rumah ibadah yang cocok dengan kriteria filter.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- AREA PETA KANAN -->
    <div wire:ignore class="flex-1 h-[40vh] md:h-full relative bg-gray-100 z-10">
        <div id="riab-map"></div>
    </div>
</div>

    <!-- SCRIPT LOGIKA PETA -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Deklarasi global
            window.riabMap = null;
            window.markersGroup = L.layerGroup();
            window.activeMarkersList = [];
            window.markersDictionary = {}; // Menyimpan referensi marker by ID

            // 1. Inisialisasi Peta
            window.riabMap = L.map('riab-map', { zoomControl: false }).setView([-8.409518, 115.188919], 9);
            
            // Pindahkan zoom control ke kanan bawah
            L.control.zoom({ position: 'bottomright' }).addTo(window.riabMap);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            }).addTo(window.riabMap);

            window.markersGroup.addTo(window.riabMap);

            // Fungsi untuk me-render markers berdasarkan data array
            function renderMarkers(dataArray) {
                window.markersGroup.clearLayers();
                window.activeMarkersList = [];
                window.markersDictionary = {};

                dataArray.forEach(function(house) {
                    if(house.lat && house.long) {
                        var marker = L.marker([house.lat, house.long]);
                        
                        var tooltipHtml = `
                            <div style="min-width: 180px; padding: 2px;">
                                <strong style="font-size: 13px; display: block; margin-bottom: 4px; color: #1F2937;">${house.nama}</strong>
                                <div style="font-size: 11px; color: #6B7280; margin-bottom: 8px; line-height: 1.4;">
                                    ${house.alamat ? house.alamat : 'Alamat tidak tersedia'}
                                </div>
                                <a href="${house.url}" target="_blank" style="display: inline-block; font-size: 11px; color: #fff; background-color: #4F46E5; padding: 4px 10px; border-radius: 4px; text-decoration: none; font-weight: bold;">
                                    Buka Profil
                                </a>
                            </div>
                        `;

                        marker.bindPopup(tooltipHtml, {
                            offset: [0, -20],
                            className: 'custom-popup rounded-lg shadow-xl'
                        });

                        // Tooltip kecil saat hover
                        marker.bindTooltip(house.nama, {
                            direction: 'top',
                            offset: [0, -35],
                            opacity: 0.9,
                            className: 'shadow-sm rounded font-medium text-xs'
                        });

                        marker.addTo(window.markersGroup);
                        window.activeMarkersList.push(marker);
                        window.markersDictionary[house.id] = marker; // Simpan untuk referensi Sidebar
                    }
                });

                // Auto-fit Peta berdasarkan lokasi marker yang tersedia
                if (window.activeMarkersList.length > 0) {
                    var group = new L.featureGroup(window.activeMarkersList);
                    window.riabMap.fitBounds(group.getBounds(), { padding: [50, 50], maxZoom: 14 });
                } else {
                    // Jika kosong, kembalikan ke view standar Bali
                    window.riabMap.setView([-8.409518, 115.188919], 9);
                }
            }

            // Inisialisasi awal list dari blade
            renderMarkers(@json($locations));

            // Mendengarkan pancaran (event dispatch) dari Livewire jika filter berubah
            window.addEventListener('locations-updated', event => {
                // event.detail[0] adalah lokasi yang dikirim (tergantung versi livewire: event.detail.locations)
                let newLocations = event.detail[0].locations;
                if(!newLocations) newLocations = event.detail.locations; // fallback format
                
                if (newLocations) {
                    renderMarkers(newLocations);
                }
            });

            // Expose function ke element Sidebar List onclick
            window.focusMapMarker = function(id, lat, lng) {
                if (!lat || !lng) return; // Jika tidak ada koordinat

                // Pergi ke koordinat tersebut
                window.riabMap.setView([lat, lng], 16, { animate: true, duration: 1 });
                
                // Buka pop-up jika marker ditemukan
                if(window.markersDictionary[id]) {
                    // Beri waktu animasi map agar mulus sebelum pop-up terbuka
                    setTimeout(() => {
                        window.markersDictionary[id].openPopup();
                    }, 500);
                }
            };
        });
    </script>
