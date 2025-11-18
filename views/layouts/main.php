<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'App Estación' ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <nav>
            <h1><a href="index.php">🌡️ App Estación</a></h1>
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