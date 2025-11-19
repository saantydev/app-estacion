<?php
$content = '
<div class="map-container">
    <div class="map-header">
        <h1>Mapa de Clientes</h1>
        <a href="index.php?url=administrator" class="btn-back">Volver</a>
    </div>
    <div id="map"></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
.map-container {
    height: 100vh;
    display: flex;
    flex-direction: column;
}

.map-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 25px 40px;
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.3),
        0 2px 16px rgba(0, 0, 0, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
}

.map-header h1 {
    color: white;
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.btn-back {
    background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
    color: white;
    padding: 15px 30px;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(78, 205, 196, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-back::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s;
}

.btn-back:hover::before {
    left: 100%;
}

.btn-back:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(78, 205, 196, 0.4);
}

#map {
    flex: 1;
    width: 100%;
    border-radius: 0 0 20px 20px;
}

.leaflet-popup-content-wrapper {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.leaflet-popup-content {
    margin: 15px;
    font-family: "Segoe UI", sans-serif;
}

@media (max-width: 768px) {
    .map-header {
        flex-direction: column;
        gap: 15px;
        padding: 20px;
        text-align: center;
    }
    
    .map-header h1 {
        font-size: 1.5rem;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Inicializar mapa
    var map = L.map("map").setView([-34.6037, -58.3816], 2);
    
    // Agregar tiles con estilo oscuro
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "© OpenStreetMap contributors"
    }).addTo(map);
    
    // Cargar datos de clientes
    fetch("api/index.php?list-clients-location")
        .then(response => response.json())
        .then(data => {
            data.forEach(function(client) {
                if (client.latitud && client.longitud) {
                    var marker = L.marker([parseFloat(client.latitud), parseFloat(client.longitud)])
                        .addTo(map);
                    
                    marker.bindPopup(`
                        <div style="text-align: center; padding: 10px;">
                            <div style="font-size: 1.1rem; font-weight: 600; color: #333; margin-bottom: 8px;">
                                📍 Cliente
                            </div>
                            <div style="margin-bottom: 5px;">
                                <strong>IP:</strong> <span style="color: #4ecdc4;">${client.ip}</span>
                            </div>
                            <div style="background: linear-gradient(135deg, #4ecdc4, #44a08d); color: white; padding: 5px 10px; border-radius: 15px; font-weight: 600;">
                                ${client.accesos} acceso${client.accesos > 1 ? "s" : ""}
                            </div>
                        </div>
                    `);
                }
            });
            
            // Ajustar vista si hay datos
            if (data.length > 0) {
                var group = new L.featureGroup(map._layers);
                if (Object.keys(group._layers).length > 0) {
                    map.fitBounds(group.getBounds().pad(0.1));
                }
            }
        })
        .catch(error => {
            console.error("Error loading client data:", error);
        });
});
</script>
';
include 'views/layouts/main.php';
?>