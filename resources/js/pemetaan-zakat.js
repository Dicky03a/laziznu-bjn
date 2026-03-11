import L from 'leaflet';
import 'leaflet/dist/leaflet.css';


export function initPemetaanZakat() {
    const mapContainer = document.getElementById('peta-zakat');
    if (!mapContainer) return;

    const dataElement = document.getElementById('pemetaan-data');
    if (!dataElement) {
        console.warn('Data pemetaan tidak ditemukan');
        return;
    }

    const data = JSON.parse(dataElement.textContent);
    const kecamatans = data.kecamatans;
    const center = data.center;
    const zoom = data.zoom;

    const map = L.map('peta-zakat', {
    attributionControl: false
}).setView(center, zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19,
    }).addTo(map);


    kecamatans.forEach(kec => {
        if (!kec.jumlah_muzakki && !kec.jumlah_mustahik) {
            return;
        }

       
        if (kec.jumlah_muzakki > 0) {
            const radiusMuzakki = Math.min(8 + Math.log(kec.jumlah_muzakki) * 2, 20);
            const markerMuzakki = L.circleMarker([kec.latitude, kec.longitude], {
                radius: radiusMuzakki,
                fillColor: '#ef4444', 
                color: '#dc2626', 
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

        if (kec.jumlah_mustahik > 0) {
            const offset = 0.015; 
            const radiusMustahik = Math.min(8 + Math.log(kec.jumlah_mustahik) * 2, 20);
            const markerMustahik = L.circleMarker(
                [kec.latitude + offset, kec.longitude + offset],
                {
                    radius: radiusMustahik,
                    fillColor: '#3b82f6', 
                    color: '#1d4ed8', 
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

    window.addEventListener('resize', () => {
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
    });

    window.pemetaanZakatMap = map;
    
}

document.addEventListener('DOMContentLoaded', initPemetaanZakat);

document.addEventListener('livewire:navigated', initPemetaanZakat);
