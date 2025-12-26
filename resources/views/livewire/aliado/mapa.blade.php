<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Rastreo en Tiempo Real - BarcoExpres</h3>
        </div>
        <div class="card-body p-0">
            <style>
                #map { 
                    height: 600px; 
                    width: 100%; 
                    border-bottom-left-radius: 10px; 
                    border-bottom-right-radius: 10px;
                    z-index: 1;
                }
                /* Evita que los controles de Leaflet se vean mal con Bootstrap */
                .leaflet-container { font-family: inherit; }
            </style>

            <div id="map"></div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // 1. Inicialización del Mapa
    // Centrado inicialmente en Caracas (puedes ajustar las coordenadas)
    var map = L.map('map').setView([10.4806, -66.9036], 12);

    // 2. Carga de Capa de Mapa (OpenStreetMap) con HTTPS
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© BarcoExpres'
    }).addTo(map);

    // Objeto para almacenar los marcadores y no duplicarlos
    var markers = {};

    // 3. Función Principal de Actualización
    function actualizarMapa() {
        fetch('/api/admin/repartidores-ultima-posicion')
            .then(res => {
                if (!res.ok) throw new Error("Error en la respuesta del servidor");
                return res.json();
            })
            .then(data => {
                data.forEach(rep => {
                    // Generamos el contenido del Popup dinámicamente
                    const popupContent = `
                        <div style="text-align: center;">
                            <b>Repartidor:</b> ${rep.name}<br>
                            <b>Velocidad:</b> ${rep.speed || 0} km/h<br>
                            <hr style="margin: 5px 0;">
                            <button onclick="enviarAlerta(${rep.user_id}, '${rep.name}')" 
                                    class="btn btn-sm btn-warning" 
                                    style="font-size: 11px; padding: 2px 5px;">
                                Enviar Alerta
                            </button>
                        </div>
                    `;

                    if (markers[rep.user_id]) {
                        // Si el repartidor ya existe en el mapa, actualizamos posición y texto
                        markers[rep.user_id].setLatLng([rep.lat, rep.lng]);
                        markers[rep.user_id].getPopup().setContent(popupContent);
                    } else {
                        // Si es nuevo, creamos el marcador y lo añadimos al objeto
                        markers[rep.user_id] = L.marker([rep.lat, rep.lng])
                            .addTo(map)
                            .bindPopup(popupContent);
                    }
                });
            })
            .catch(err => console.error("Error al obtener posiciones:", err));
    }

    // 4. Función para Enviar Alerta (Global para que el botón la encuentre)
    function enviarAlerta(userId, userName) {
        const msg = prompt(`Escribe el mensaje para ${userName}:`);
        
        if (msg) {
            fetch(`/api/admin/enviar-alerta/${userId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token de seguridad de Laravel
                },
                body: JSON.stringify({ mensaje: msg })
            })
            .then(res => {
                if (res.ok) {
                    alert("✅ Alerta enviada correctamente a " + userName);
                } else {
                    alert("❌ Error al enviar la alerta.");
                }
            })
            .catch(err => console.error("Error en el envío:", err));
        }
    }

    // 5. Ciclo de ejecución
    // Actualizar cada 10 segundos
    setInterval(actualizarMapa, 10000);
    
    // Ejecutar inmediatamente al cargar la página
    actualizarMapa();

    // Pequeño truco para asegurar que el mapa se dibuje bien si está dentro de tabs o modales
    setTimeout(function(){ map.invalidateSize(); }, 500);

</script>