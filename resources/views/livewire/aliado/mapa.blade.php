<div>
<!DOCTYPE html>
<html>
<head>
    <title>Mapa Básico Caracas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        /* 2. DEFINIR EL TAMAÑO DEL MAPA (Si no tiene altura, no se ve) */
        #map {
            height: 500px;
            width: 100%;
            border: 2px solid #ccc;
        }
    </style>
</head>
<body>

    <h3>Mi primer mapa de Caracas</h3>
    
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // 5. INICIALIZAR EL MAPA
        // [10.4806, -66.9036] son las coordenadas de Caracas
        // 12 es el nivel de zoom
        var map = L.map('map').setView([10.4806, -66.9036], 12);

        // 6. CARGAR LOS "TILES" (Las imágenes de los mapas de OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // 7. AGREGAR UN MARCADOR DE PRUEBA
        L.marker([10.4806, -66.9036]).addTo(map)
            .bindPopup('¡Hola Caracas!')
            .openPopup();
    </script>

</body>
</html>
</div>