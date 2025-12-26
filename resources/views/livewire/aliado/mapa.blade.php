<div>
    <div class="container-fluid">
        <h3>Rastreo en Tiempo Real - BarcoExpres (Google Maps)</h3>
        <div id="map" style="height: 500px; width: 100%; border-radius: 10px; border: 2px solid #ddd;"></div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY_AQUI&callback=initMap" async defer></script>

    <script>
        let map;
        let markers = {};

        // Esta función se ejecuta automáticamente cuando carga Google Maps
        function initMap() {
            // Inicializar el mapa centrado en Caracas
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: { lat: 10.4806, lng: -66.9036 },
                mapTypeControl: true,
                streetViewControl: false
            });

            // Una vez cargado el mapa, empezamos a rastrear
            actualizarMapa();
            setInterval(actualizarMapa, 10000);
        }

        async function actualizarMapa() {
            try {
                const response = await fetch('/api/admin/repartidores-ultima-posicion');
                const data = await response.json();

                data.forEach(rep => {
                    const position = { lat: parseFloat(rep.lat), lng: parseFloat(rep.lng) };
                    const contentString = `
                        <div style="color:black;">
                            <b>Repartidor:</b> ${rep.name}<br>
                            <b>Vel:</b> ${rep.speed} km/h<br>
                            <hr>
                            <button onclick="enviarAlerta(${rep.user_id})" class="btn btn-xs btn-warning" style="background:#ffc107; border:1px solid #000; padding:2px 5px; cursor:pointer;">
                                Enviar Alerta
                            </button>
                        </div>
                    `;

                    if (markers[rep.user_id]) {
                        // Si ya existe, solo movemos la posición
                        markers[rep.user_id].marker.setPosition(position);
                        // Actualizamos el contenido del popup por si cambió la velocidad
                        markers[rep.user_id].infoWindow.setContent(contentString);
                    } else {
                        // Si es nuevo, creamos el Marcador y su Ventana de Información (Popup)
                        const infoWindow = new google.maps.InfoWindow({
                            content: contentString
                        });

                        const marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            title: rep.name,
                            icon: 'https://maps.google.com/mapfiles/kml/shapes/motorcycling.png' // Icono de moto
                        });

                        // Abrir popup al hacer clic
                        marker.addListener("click", () => {
                            infoWindow.open(map, marker);
                        });

                        // Guardamos ambos en nuestro objeto global
                        markers[rep.user_id] = { marker, infoWindow };
                    }
                });
            } catch (error) {
                console.error("Error al obtener posiciones:", error);
            }
        }

        function enviarAlerta(userId) {
            const msg = prompt("Escribe el mensaje para el repartidor:");
            if (msg) {
                fetch(`/api/admin/enviar-alerta/${userId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token de seguridad de Laravel
                    },
                    body: JSON.stringify({ mensaje: msg })
                }).then(res => {
                    if(res.ok) alert("Mensaje enviado");
                });
            }
        }
    </script>
</div>