# App Estación

Aplicación web para monitorear estaciones meteorológicas en tiempo real.

## Características

- **Landing Page**: Descripción de la aplicación con acceso al panel
- **Panel de Estaciones**: Lista todas las estaciones disponibles con información básica
- **Detalle de Estación**: Muestra información específica de cada estación

## Estructura del Proyecto

```
app-estacion/
├── controllers/          # Controladores MVC
├── models/              # Modelos y motor de plantillas
├── views/               # Vistas de la aplicación
├── assets/              # CSS y JavaScript
├── .htaccess           # Configuración de URLs amigables
├── index.php           # Router principal
└── env.php             # Configuración (no incluido en Git)
```

## Instalación

1. Clona el repositorio
2. Crea el archivo `env.php` con las constantes necesarias
3. Configura un servidor web con PHP
4. Accede a la aplicación

## API

La aplicación consume datos de: https://mattprofe.com.ar/proyectos/app-estacion/

## Tecnologías

- PHP (MVC)
- JavaScript (ES6+)
- CSS3
- HTML5