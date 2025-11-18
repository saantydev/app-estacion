// Configuración de la API
const API_BASE = 'https://mattprofe.com.ar/proyectos/app-estacion/';

// Datos de estaciones (basado en las URLs proporcionadas)
const estacionesData = [
    { chipid: '713630', apodo: 'MattLab I', ubicacion: 'Buenos Aires, Tortuguitas', visitas: Math.floor(Math.random() * 1000) + 100 },
    { chipid: '1726113', apodo: 'Villa Giardino', ubicacion: 'Córdoba, Villa Giardino', visitas: Math.floor(Math.random() * 1000) + 100 },
    { chipid: '3099001', apodo: 'Expotécnica E.E.S.T. N°3', ubicacion: 'Buenos Aires, Tortuguitas', visitas: Math.floor(Math.random() * 1000) + 100 },
    { chipid: '3973796', apodo: 'MattLab II', ubicacion: 'Buenos Aires, Tortuguitas', visitas: Math.floor(Math.random() * 1000) + 100 },
    { chipid: '11214452', apodo: 'AEROCLUB LA CUMBRE', ubicacion: 'Córdoba, Aeroclub La Cumbre', visitas: Math.floor(Math.random() * 1000) + 100 }
];

// Función para cargar estaciones en el panel
function cargarEstaciones() {
    const grid = document.getElementById('estacionesGrid');
    const template = document.getElementById('estacionTemplate');
    const loading = document.getElementById('loading');
    
    if (grid && template) {
        loading.style.display = 'none';
        
        estacionesData.forEach(estacion => {
            const clone = template.content.cloneNode(true);
            
            clone.querySelector('.apodo').textContent = estacion.apodo;
            clone.querySelector('.ubicacion').textContent = estacion.ubicacion;
            clone.querySelector('.contador-visitas').textContent = estacion.visitas;
            clone.querySelector('.btn-detalle').dataset.chipid = estacion.chipid;
            
            grid.appendChild(clone);
        });
    }
}

// Función para cargar detalle de estación
function cargarDetalleEstacion(chipid) {
    const estacion = estacionesData.find(e => e.chipid === chipid);
    
    const loading = document.getElementById('loading');
    const detalle = document.getElementById('estacionDetalle');
    
    if (loading && detalle) {
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