// Configuración de la API
const API_BASE = 'https://mattprofe.com.ar/proyectos/app-estacion/';

// Función para cargar estaciones en el panel
async function cargarEstaciones() {
    try {
        const response = await fetch(`${API_BASE}api/estaciones`);
        const estaciones = await response.json();
        
        const grid = document.getElementById('estacionesGrid');
        const template = document.getElementById('estacionTemplate');
        const loading = document.getElementById('loading');
        
        if (grid && template) {
            loading.style.display = 'none';
            
            estaciones.forEach(estacion => {
                const clone = template.content.cloneNode(true);
                
                clone.querySelector('.apodo').textContent = estacion.apodo || 'Sin nombre';
                clone.querySelector('.ubicacion').textContent = estacion.ubicacion || 'Ubicación no disponible';
                clone.querySelector('.contador-visitas').textContent = estacion.visitas || 0;
                clone.querySelector('.btn-detalle').dataset.chipid = estacion.chipid;
                
                grid.appendChild(clone);
            });
        }
    } catch (error) {
        console.error('Error al cargar estaciones:', error);
        const loading = document.getElementById('loading');
        if (loading) {
            loading.textContent = 'Error al cargar las estaciones';
        }
    }
}

// Función para cargar detalle de estación
async function cargarDetalleEstacion(chipid) {
    try {
        const response = await fetch(`${API_BASE}api/estacion/${chipid}`);
        const estacion = await response.json();
        
        const loading = document.getElementById('loading');
        const detalle = document.getElementById('estacionDetalle');
        
        if (loading && detalle) {
            loading.style.display = 'none';
            detalle.style.display = 'block';
            
            document.getElementById('estacionApodo').textContent = estacion.apodo || 'Estación';
            document.getElementById('estacionUbicacion').textContent = estacion.ubicacion || 'No disponible';
            document.getElementById('estacionChipid').textContent = chipid;
        }
    } catch (error) {
        console.error('Error al cargar detalle:', error);
        const loading = document.getElementById('loading');
        if (loading) {
            loading.textContent = 'Error al cargar el detalle de la estación';
        }
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