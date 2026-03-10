import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

/**
 * Inisialisasi peta zakat Bojonegoro
 * Menampilkan marker untuk Muzakki (merah) dan Mustahik (biru)
 */
export function initPemetaanZakat() {
    const mapContainer = document.getElementById('peta-zakat');
    if (!mapContainer) return;

    // Data kecamatan dari Livewire
    const dataElement = document.getElementById('pemetaan-data');
    if (!dataElement) {
        console.warn('Data pemetaan tidak ditemukan');
        return;
    }

    const data = JSON.parse(dataElement.textContent);
    const kecamatans = data.kecamatans;
    const center = data.center;
    const zoom = data.zoom;

    // Inisialisasi peta
    const map = L.map('peta-zakat').setView(center, zoom);

    // Tambah tile layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19,
    }).addTo(map);

    /**
     * Render marker untuk setiap kecamatan
     * Muzakki (red) dan Mustahik (blue)
     * Hanya menampilkan marker untuk kecamatan dengan koordinat
     */
    kecamatans.forEach(kec => {
        // Skip kecamatan tanpa koordinat
        if (!kec.jumlah_muzakki && !kec.jumlah_mustahik) {
            return;
        }

        // Marker Muzakki (Merah)
        if (kec.jumlah_muzakki > 0) {
            const radiusMuzakki = Math.min(8 + Math.log(kec.jumlah_muzakki) * 2, 20);
            const markerMuzakki = L.circleMarker([kec.latitude, kec.longitude], {
                radius: radiusMuzakki,
                fillColor: '#ef4444', // red-500
                color: '#dc2626', // red-600
                weight: 2,
                opacity: 0.8,
                fillOpacity: 0.7,
            }).addTo(map);

            markerMuzakki.bindPopup(`
                <div class="p-3 font-sans text-sm">
                    <h4 class="font-bold text-slate-900 mb-2">${kec.nama}</h4>
                    <div class="space-y-1">
                        <p><span class="text-red-600 font-bold">●</span> <strong>Muzakki:</strong> <span class="text-lg font-bold text-red-600">${kec.jumlah_muzakki}</span></p>
                        <p><span class="text-blue-600 font-bold">●</span> <strong>Mustahik:</strong> <span class="text-lg font-bold text-blue-600">${kec.jumlah_mustahik}</span></p>
                    </div>
                </div>
            `);
        }

        // Marker Mustahik (Biru) - offset untuk menghindari overlap
        if (kec.jumlah_mustahik > 0) {
            const offset = 0.015; // offset untuk menghindari overlap sempurna
            const radiusMustahik = Math.min(8 + Math.log(kec.jumlah_mustahik) * 2, 20);
            const markerMustahik = L.circleMarker(
                [kec.latitude + offset, kec.longitude + offset],
                {
                    radius: radiusMustahik,
                    fillColor: '#3b82f6', // blue-500
                    color: '#1d4ed8', // blue-700
                    weight: 2,
                    opacity: 0.8,
                    fillOpacity: 0.7,
                }
            ).addTo(map);

            markerMustahik.bindPopup(`
                <div class="p-3 font-sans text-sm">
                    <h4 class="font-bold text-slate-900 mb-2">${kec.nama}</h4>
                    <div class="space-y-1">
                        <p><span class="text-red-600 font-bold">●</span> <strong>Muzakki:</strong> <span class="text-lg font-bold text-red-600">${kec.jumlah_muzakki}</span></p>
                        <p><span class="text-blue-600 font-bold">●</span> <strong>Mustahik:</strong> <span class="text-lg font-bold text-blue-600">${kec.jumlah_mustahik}</span></p>
                    </div>
                </div>
            `);
        }
    });

    /**
     * Event listener untuk card kecamatan
     * Ketika diklik, peta akan berpindah ke lokasi kecamatan
     */
    document.querySelectorAll('.kecamatan-card').forEach(card => {
        card.addEventListener('click', function () {
            const lat = parseFloat(this.dataset.lat);
            const lng = parseFloat(this.dataset.lng);
            map.flyTo([lat, lng], 13, {
                duration: 1,
            });
        });
    });

    // Resize map saat window diubah ukuran
    window.addEventListener('resize', () => {
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
    });

    // Expose map untuk debugging jika diperlukan
    window.pemetaanZakatMap = map;
}

// Inisialisasi saat DOM ready
document.addEventListener('DOMContentLoaded', initPemetaanZakat);

// Reinitialize saat navigasi Livewire
document.addEventListener('livewire:navigated', initPemetaanZakat);
