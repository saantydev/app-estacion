<?php
$content = '
<div class="panel-container">
    <h1>Panel de Estaciones Meteorológicas</h1>
    <div class="loading" id="loading">Cargando estaciones...</div>
    <div class="estaciones-grid" id="estacionesGrid"></div>
</div>

<template id="estacionTemplate">
    <div class="estacion-card">
        <div class="estacion-info">
            <h3 class="apodo"></h3>
            <p class="ubicacion"></p>
            <span class="visitas">👁️ <span class="contador-visitas"></span> visitas</span>
        </div>
        <div class="estacion-actions">
            <button class="btn-detalle" onclick="verDetalle(this.dataset.chipid)">Ver Detalle</button>
        </div>
    </div>
</template>
';
include 'views/layouts/main.php';
?>