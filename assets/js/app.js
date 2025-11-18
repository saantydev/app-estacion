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

// Función para cargar detalle de estación
function cargarDetalleEstacion(chipid) {
    const loading = document.getElementById('loading');
    const detalle = document.getElementById('estacionDetalle');
    
    const estacionesLocal = [
        { chipid: '713630', apodo: 'MattLab I', ubicacion: 'Buenos Aires, Tortuguitas' },
        { chipid: '1726113', apodo: 'Villa Giardino', ubicacion: 'Córdoba, Villa Giardino' },
        { chipid: '3099001', apodo: 'Expotécnica E.E.S.T. N°3', ubicacion: 'Buenos Aires, Tortuguitas' },
        { chipid: '3973796', apodo: 'MattLab II', ubicacion: 'Buenos Aires, Tortuguitas' },
        { chipid: '11214452', apodo: 'AEROCLUB LA CUMBRE', ubicacion: 'Córdoba, Aeroclub La Cumbre' }
    ];
    
    const estacion = estacionesLocal.find(e => e.chipid === chipid);
    
    loading.style.display = 'none';
    detalle.style.display = 'block';
    
    if (estacion) {
        document.getElementById('estacionApodo').textContent = estacion.apodo;
        document.getElementById('estacionUbicacion').textContent = estacion.ubicacion;
        document.getElementById('estacionChipid').textContent = chipid;
    } else {
        document.getElementById('estacionApodo').textContent = 'Estación no encontrada';
        document.getElementById('estacionUbicacion').textContent = 'No disponible';
        document.getElementById('estacionChipid').textContent = chipid;
    }
}

// Función para navegar al detalle
function verDetalle(chipid) {
    window.location.href = `detalle/${chipid}`;
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
    }
});