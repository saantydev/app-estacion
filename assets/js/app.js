// Configuración de la API
const API_BASE = 'https://mattprofe.com.ar/proyectos/app-estacion/';

// Función para cargar estaciones en el panel
async function cargarEstaciones() {
    const grid = document.getElementById('estacionesGrid');
    const template = document.getElementById('estacionTemplate');
    const loading = document.getElementById('loading');
    
    try {
        // Probar diferentes endpoints posibles
        const endpoints = ['api.php', 'estaciones.php', 'api/estaciones.json', 'data.json'];
        let estaciones = null;
        
        for (const endpoint of endpoints) {
            try {
                const response = await fetch(`${API_BASE}${endpoint}`);
                if (response.ok) {
                    const data = await response.json();
                    estaciones = data;
                    console.log(`API encontrada en: ${endpoint}`);
                    break;
                }
            } catch (e) {
                continue;
            }
        }
        
        if (!estaciones) {
            // Si no hay API, usar datos locales
            estaciones = [
                { chipid: '713630', apodo: 'MattLab I', ubicacion: 'Buenos Aires, Tortuguitas', visitas: 245 },
                { chipid: '1726113', apodo: 'Villa Giardino', ubicacion: 'Córdoba, Villa Giardino', visitas: 189 },
                { chipid: '3099001', apodo: 'Expotécnica E.E.S.T. N°3', ubicacion: 'Buenos Aires, Tortuguitas', visitas: 312 },
                { chipid: '3973796', apodo: 'MattLab II', ubicacion: 'Buenos Aires, Tortuguitas', visitas: 156 },
                { chipid: '11214452', apodo: 'AEROCLUB LA CUMBRE', ubicacion: 'Córdoba, Aeroclub La Cumbre', visitas: 98 }
            ];
        }
        
        loading.style.display = 'none';
        
        estaciones.forEach(estacion => {
            const clone = template.content.cloneNode(true);
            
            clone.querySelector('.apodo').textContent = estacion.apodo || estacion.nombre || 'Sin nombre';
            clone.querySelector('.ubicacion').textContent = estacion.ubicacion || estacion.location || 'Sin ubicación';
            clone.querySelector('.contador-visitas').textContent = estacion.visitas || estacion.visits || 0;
            clone.querySelector('.btn-detalle').dataset.chipid = estacion.chipid || estacion.id;
            
            grid.appendChild(clone);
        });
        
    } catch (error) {
        console.error('Error:', error);
        loading.textContent = 'Error al cargar estaciones';
    }
}

// Función para cargar detalle de estación desde la API real
async function cargarDetalleEstacion(chipid) {
    const loading = document.getElementById('loading');
    const detalle = document.getElementById('estacionDetalle');
    
    try {
        const response = await fetch(`https://mattprofe.com.ar/proyectos/app-estacion/panel.php?chipid=${chipid}`);
        const html = await response.text();
        
        // Extraer datos del HTML usando regex
        const apodoMatch = html.match(/<h2[^>]*>([^<]+)<\/h2>/);
        const ubicacionMatch = html.match(/<p[^>]*class="[^"]*ubicacion[^"]*"[^>]*>([^<]+)<\/p>/) || 
                              html.match(/<span[^>]*>([^<]*(?:Buenos Aires|Córdoba)[^<]*)<\/span>/);
        
        loading.style.display = 'none';
        detalle.style.display = 'block';
        
        if (apodoMatch) {
            document.getElementById('estacionApodo').textContent = apodoMatch[1].trim();
        }
        
        if (ubicacionMatch) {
            document.getElementById('estacionUbicacion').textContent = ubicacionMatch[1].trim();
        }
        
        document.getElementById('estacionChipid').textContent = chipid;
        
    } catch (error) {
        console.error('Error al cargar desde API:', error);
        loading.style.display = 'none';
        detalle.style.display = 'block';
        
        // Fallback con datos conocidos
        const fallback = {
            '713630': { apodo: 'MattLab I', ubicacion: 'Buenos Aires, Tortuguitas' },
            '1726113': { apodo: 'Villa Giardino', ubicacion: 'Córdoba, Villa Giardino' },
            '3099001': { apodo: 'Expotécnica E.E.S.T. N°3', ubicacion: 'Buenos Aires, Tortuguitas' },
            '3973796': { apodo: 'MattLab II', ubicacion: 'Buenos Aires, Tortuguitas' },
            '11214452': { apodo: 'AEROCLUB LA CUMBRE', ubicacion: 'Córdoba, Aeroclub La Cumbre' }
        };
        
        const estacion = fallback[chipid];
        if (estacion) {
            document.getElementById('estacionApodo').textContent = estacion.apodo;
            document.getElementById('estacionUbicacion').textContent = estacion.ubicacion;
        }
        document.getElementById('estacionChipid').textContent = chipid;
    }
}

// Función para navegar al detalle
function verDetalle(chipid) {
    window.location.href = `index.php?url=detalle/${chipid}`;
}

// Variables globales para los gráficos
let charts = {};
let updateInterval;

// Función para generar datos simulados
function generarDatosSimulados() {
    return {
        temperatura: Math.round((Math.random() * 20 + 15) * 10) / 10, // 15-35°C
        humedad: Math.round(Math.random() * 60 + 30), // 30-90%
        viento: Math.round((Math.random() * 25 + 5) * 10) / 10, // 5-30 km/h
        presion: Math.round((Math.random() * 50 + 1000) * 10) / 10, // 1000-1050 hPa
        incendio: Math.round(Math.random() * 100) // 0-100%
    };
}

// Función para actualizar valores en pantalla
function actualizarValores(datos) {
    document.getElementById('tempValor').textContent = `${datos.temperatura}°C`;
    document.getElementById('humedadValor').textContent = `${datos.humedad}%`;
    document.getElementById('vientoValor').textContent = `${datos.viento} km/h`;
    document.getElementById('presionValor').textContent = `${datos.presion} hPa`;
    document.getElementById('incendioValor').textContent = `${datos.incendio}%`;
}

// Función para crear gráficos
function crearGraficos() {
    const datos = generarDatosSimulados();
    actualizarValores(datos);
    
    // Gráfico de Temperatura
    const tempCtx = document.getElementById('temperaturaChart');
    if (tempCtx) {
        charts.temperatura = new Chart(tempCtx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [datos.temperatura, 50 - datos.temperatura],
                    backgroundColor: ['#ff6b6b', 'rgba(255,255,255,0.1)'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                cutout: '75%'
            }
        });
    }
    
    // Gráfico de Humedad
    const humCtx = document.getElementById('humedadChart');
    if (humCtx) {
        charts.humedad = new Chart(humCtx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [datos.humedad, 100 - datos.humedad],
                    backgroundColor: ['#4ecdc4', 'rgba(255,255,255,0.1)'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                cutout: '75%'
            }
        });
    }
    
    // Gráfico de Viento
    const vientoCtx = document.getElementById('vientoChart');
    if (vientoCtx) {
        charts.viento = new Chart(vientoCtx, {
            type: 'bar',
            data: {
                labels: ['Viento'],
                datasets: [{
                    data: [datos.viento],
                    backgroundColor: ['#45b7aa'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 30,
                        display: false
                    },
                    x: {
                        display: false
                    }
                }
            }
        });
    }
    
    // Gráfico de Presión
    const presionCtx = document.getElementById('presionChart');
    if (presionCtx) {
        charts.presion = new Chart(presionCtx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5'],
                datasets: [{
                    data: [datos.presion, datos.presion + 2, datos.presion - 1, datos.presion + 1, datos.presion],
                    borderColor: '#ffd93d',
                    backgroundColor: 'rgba(255, 217, 61, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { display: false },
                    x: { display: false }
                }
            }
        });
    }
    
    // Gráfico de Riesgo de Incendio
    const incendioCtx = document.getElementById('incendioChart');
    if (incendioCtx) {
        charts.incendio = new Chart(incendioCtx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [datos.incendio, 100 - datos.incendio],
                    backgroundColor: ['#ff9f43', 'rgba(255,255,255,0.1)'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                cutout: '75%'
            }
        });
    }
}

// Función para actualizar gráficos
function actualizarGraficos() {
    const datos = generarDatosSimulados();
    actualizarValores(datos);
    
    if (charts.temperatura) {
        charts.temperatura.data.datasets[0].data = [datos.temperatura, 50 - datos.temperatura];
        charts.temperatura.update('none');
    }
    
    if (charts.humedad) {
        charts.humedad.data.datasets[0].data = [datos.humedad, 100 - datos.humedad];
        charts.humedad.update('none');
    }
    
    if (charts.viento) {
        charts.viento.data.datasets[0].data = [datos.viento];
        charts.viento.update('none');
    }
    
    if (charts.presion) {
        const nuevosDatos = [datos.presion, datos.presion + 2, datos.presion - 1, datos.presion + 1, datos.presion];
        charts.presion.data.datasets[0].data = nuevosDatos;
        charts.presion.update('none');
    }
    
    if (charts.incendio) {
        charts.incendio.data.datasets[0].data = [datos.incendio, 100 - datos.incendio];
        charts.incendio.update('none');
    }
}

// Inicialización según la página
document.addEventListener('DOMContentLoaded', function() {
    // Si estamos en el panel, cargar estaciones
    if (document.getElementById('estacionesGrid')) {
        cargarEstaciones();
    }
    
    // Si estamos en detalle y hay chipid, cargar detalle
    if (typeof chipid !== 'undefined' && chipid) {
        cargarDetalleEstacion(chipid);
        
        // Crear gráficos después de cargar el detalle
        setTimeout(() => {
            crearGraficos();
            
            // Actualizar cada 60 segundos
            updateInterval = setInterval(actualizarGraficos, 60000);
        }, 1000);
    }
});

// Limpiar intervalo al salir de la página
window.addEventListener('beforeunload', function() {
    if (updateInterval) {
        clearInterval(updateInterval);
    }
});