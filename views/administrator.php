<?php
$content = '
<div class="admin-container">
    <div class="admin-header">
        <h1>Panel de Administración</h1>
        <div class="admin-actions">
            <a href="index.php?url=admin-logout" class="btn-logout">Cerrar Sesión</a>
        </div>
    </div>
    
    <div class="admin-content">
        <div class="admin-card map-card">
            <a href="index.php?url=map" class="btn-map">Mapa de Clientes</a>
        </div>
        
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <h3>Usuarios Registrados</h3>
                <div class="stat-number">' . $total_users . '</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">🌍</div>
                <h3>Clientes Únicos</h3>
                <div class="stat-number">' . $total_clients . '</div>
            </div>
        </div>
    </div>
</div>

<style>
.admin-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    padding: 30px 40px;
    border-radius: 24px;
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.3),
        0 2px 16px rgba(0, 0, 0, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.15);
}

.admin-header h1 {
    color: white;
    margin: 0;
    font-size: 2.2rem;
    font-weight: 700;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.btn-logout {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
    color: white;
    padding: 15px 30px;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
}

.btn-logout:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(255, 107, 107, 0.4);
}

.admin-content {
    display: grid;
    gap: 30px;
}

.map-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    padding: 50px;
    border-radius: 24px;
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.3),
        0 2px 16px rgba(0, 0, 0, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.15);
    text-align: center;
}

.btn-map {
    display: inline-block;
    background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
    color: white;
    padding: 25px 50px;
    text-decoration: none;
    border-radius: 50px;
    font-size: 1.3rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(78, 205, 196, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-map::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s;
}

.btn-map:hover::before {
    left: 100%;
}

.btn-map:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(78, 205, 196, 0.4);
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
}

.stat-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    padding: 40px 30px;
    border-radius: 24px;
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.3),
        0 2px 16px rgba(0, 0, 0, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.15);
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 
        0 12px 40px rgba(0, 0, 0, 0.4),
        0 4px 20px rgba(0, 0, 0, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.stat-icon {
    font-size: 3rem;
    margin-bottom: 15px;
}

.stat-card h3 {
    color: rgba(255, 255, 255, 0.95);
    margin-bottom: 20px;
    font-size: 1.1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-number {
    color: #4ecdc4;
    font-size: 3.5rem;
    font-weight: 700;
    text-shadow: 0 2px 10px rgba(78, 205, 196, 0.3);
    margin: 0;
}

@media (max-width: 768px) {
    .admin-header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .admin-header h1 {
        font-size: 1.8rem;
    }
    
    .stats-container {
        grid-template-columns: 1fr;
    }
}
</style>
';
include 'views/layouts/main.php';
?>