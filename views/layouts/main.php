<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'App Estación' ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>
<body>
    <header>
        <nav>
            <h1><a href="index.php">🌡️ App Estación</a></h1>
            <div class="nav-actions">
                <?php if (isset($_SESSION['user_id']) || isset($_SESSION['admin_logged'])): ?>
                    <a href="index.php?url=logout" class="btn-logout-header">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="index.php?url=login" class="btn-login-header">Iniciar Sesión</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    
    <main>
        <?= $content ?>
    </main>

    <footer>
        <p>&copy; 2024 App Estación - Monitoreo Meteorológico</p>
    </footer>

    <script src="assets/js/app.js"></script>
</body>
</html>