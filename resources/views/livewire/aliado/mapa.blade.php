<div>
    <div class="container-fluid">
        <h3>Rastreo en Tiempo Real - BarcoExpres</h3>
        <div id="map" style="height: 500px; width: 100%; border-radius: 10px; border: 2px solid #ddd;"></div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // Inicializar el mapa centrado en una ubicación por defecto
        var map = L.map('map').setView([10.4806, -66.9036], 12); // Coordenadas de ejemplo (Caracas)

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© BarcoExpres'
        }).addTo(map);

        var markers = {};

        function actualizarMapa() {
            fetch('/api/admin/repartidores-ultima-posicion')
                .then(res => res.json())
                .then(data => {
                    data.forEach(rep => {
                        // Si el repartidor ya tiene un marcador, solo lo movemos
                        if (markers[rep.user_id]) {
                            markers[rep.user_id].setLatLng([rep.lat, rep.lng]);
                        } else {
                            // Si es nuevo, creamos el marcador con su nombre
                            markers[rep.user_id] = L.marker([rep.lat, rep.lng])
                                .addTo(map)
                                .bindPopup(`<b>Repartidor:</b> ${rep.name}<br><b>Vel:</b> ${rep.speed} km/h`);
                        }
                    });
                });
        }

        // Actualizar el mapa cada 10 segundos automáticamente
        setInterval(actualizarMapa, 10000);
        actualizarMapa();

        // En el popup del marcador del mapa:
        markers[rep.user_id] = L.marker([rep.lat, rep.lng])
            .addTo(map)
            .bindPopup(`
                <b>${rep.name}</b><br>
                <button onclick="enviarAlerta(${rep.user_id})" class="btn btn-xs btn-warning">
                    Enviar Alerta
                </button>
            `);

        function enviarAlerta(userId) {
            const msg = prompt("Escribe el mensaje para el repartidor:");
            if(msg) {
                fetch(`/api/admin/enviar-alerta/${userId}`, {
                    method: 'POST',
                    body: JSON.stringify({ mensaje: msg })
                });
            }
        }
    </script>
</div>
