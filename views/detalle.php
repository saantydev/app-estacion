<?php
$content = '
<div class="detalle-container">
    <div class="loading" id="loading">Cargando información de la estación...</div>
    <div class="estacion-detalle" id="estacionDetalle" style="display: none;">
        <div class="detalle-header">
            <button onclick="history.back()" class="btn-back">← Volver</button>
            <h1 id="estacionApodo">Estación</h1>
        </div>
        <div class="detalle-info">
            <div class="info-card">
                <h3>📍 Ubicación</h3>
                <p id="estacionUbicacion">-</p>
            </div>
            <div class="info-card">
                <h3>🆔 Chip ID</h3>
                <p id="estacionChipid">' . htmlspecialchars($chipid) . '</p>
            </div>
        </div>
        
        <div class="graficos-container">
            <div class="grafico-card">
                <h3>🌡️ Temperatura</h3>
                <canvas id="temperaturaChart"></canvas>
            </div>
            <div class="grafico-card">
                <h3>💧 Humedad</h3>
                <canvas id="humedadChart"></canvas>
            </div>
            <div class="grafico-card">
                <h3>💨 Viento</h3>
                <canvas id="vientoChart"></canvas>
            </div>
            <div class="grafico-card">
                <h3>🌪️ Presión Atmosférica</h3>
                <canvas id="presionChart"></canvas>
            </div>
            <div class="grafico-card">
                <h3>🔥 Riesgo de Incendio</h3>
                <canvas id="incendioChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const chipid = "' . htmlspecialchars($chipid) . '";
</script>
';
include 'views/layouts/main.php';
?>