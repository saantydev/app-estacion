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
                <div class="chart-container">
                    <canvas id="temperaturaChart"></canvas>
                </div>
                <div class="valor-actual" id="tempValor">--°C</div>
            </div>
            <div class="grafico-card">
                <h3>💧 Humedad</h3>
                <div class="chart-container">
                    <canvas id="humedadChart"></canvas>
                </div>
                <div class="valor-actual" id="humedadValor">--%</div>
            </div>
            <div class="grafico-card">
                <h3>💨 Viento</h3>
                <div class="chart-container">
                    <canvas id="vientoChart"></canvas>
                </div>
                <div class="valor-actual" id="vientoValor">-- km/h</div>
            </div>
            <div class="grafico-card">
                <h3>🌪️ Presión</h3>
                <div class="chart-container">
                    <canvas id="presionChart"></canvas>
                </div>
                <div class="valor-actual" id="presionValor">-- hPa</div>
            </div>
            <div class="grafico-card">
                <h3>🔥 Riesgo Incendio</h3>
                <div class="chart-container">
                    <canvas id="incendioChart"></canvas>
                </div>
                <div class="valor-actual" id="incendioValor">--%</div>
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