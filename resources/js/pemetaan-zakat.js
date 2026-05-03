import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export function initPemetaanZakat() {
    const mapContainer = document.getElementById('peta-zakat');
    if (!mapContainer || window.pemetaanZakatMap) return; // Guard agar tidak double init

    const dataElement = document.getElementById('pemetaan-data');
    if (!dataElement) return;

    const data = JSON.parse(dataElement.textContent);
    const { kecamatans, center, zoom } = data;

    const map = L.map('peta-zakat', {
        attributionControl: false,
        scrollWheelZoom: false // Opsional: agar tidak mengganggu scroll halaman
    }).setView(center, zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19,
    }).addTo(map);

    kecamatans.forEach(kec => {
        if (!kec.jumlah_muzakki && !kec.jumlah_mustahik) return;

        // Popup Content Helper
        const popupContent = `
            <div class="p-3 font-sans text-sm">
                <h4 class="font-bold text-slate-900 mb-2">${kec.nama}</h4>
                <div class="space-y-1">
                    <p><span class="text-red-600 font-bold">●</span> <strong>Muzakki:</strong> <span class="text-lg font-bold text-red-600">${kec.jumlah_muzakki}</span></p>
                    <p><span class="text-blue-600 font-bold">●</span> <strong>Mustahik:</strong> <span class="text-lg font-bold text-blue-600">${kec.jumlah_mustahik}</span></p>
                </div>
            </div>`;

        if (kec.jumlah_muzakki > 0) {
            L.circleMarker([kec.latitude, kec.longitude], {
                radius: Math.min(8 + Math.log(kec.jumlah_muzakki) * 2, 20),
                fillColor: '#ef4444', 
                color: '#dc2626', 
                weight: 2,
                fillOpacity: 0.7,
            }).addTo(map).bindPopup(popupContent);
        }

        if (kec.jumlah_mustahik > 0) {
            const offset = 0.005; 
            L.circleMarker([kec.latitude + offset, kec.longitude + offset], {
                radius: Math.min(8 + Math.log(kec.jumlah_mustahik) * 2, 20),
                fillColor: '#3b82f6', 
                color: '#1d4ed8', 
                weight: 2,
                fillOpacity: 0.7,
            }).addTo(map).bindPopup(popupContent);
        }
    });

    window.addEventListener('resize', () => {
        setTimeout(() => map.invalidateSize(), 100);
    });

    window.pemetaanZakatMap = map;
}