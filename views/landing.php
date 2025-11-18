<?php
$content = '
<div class="landing-container">
    <div class="hero">
        <h1>🌡️ App Estación Meteorológica</h1>
        <p class="description">
            Monitorea en tiempo real las condiciones meteorológicas de múltiples estaciones. 
            Accede a datos de temperatura, humedad y otros parámetros climáticos desde cualquier lugar.
        </p>
        <div class="features">
            <div class="feature">
                <h3>📊 Datos en Tiempo Real</h3>
                <p>Información actualizada constantemente</p>
            </div>
            <div class="feature">
                <h3>🗺️ Múltiples Ubicaciones</h3>
                <p>Red de estaciones distribuidas</p>
            </div>
            <div class="feature">
                <h3>📱 Acceso Móvil</h3>
                <p>Disponible desde cualquier dispositivo</p>
            </div>
        </div>
        <a href="index.php?url=panel" class="btn-primary">Ver Panel de Estaciones</a>
    </div>
</div>
';
include 'views/layouts/main.php';
?>