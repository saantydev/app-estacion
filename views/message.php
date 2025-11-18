<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Estación</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-form">
            <?php if (isset($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if (isset($message)): ?>
                <div class="success"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
            
            <div class="auth-links">
                <a href="index.php?url=login">Ir al Login</a>
            </div>
        </div>
    </div>
</body>
</html>