<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - App Estación</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-form">
            <h2>Restablecer Contraseña</h2>
            
            <?php if (isset($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if (isset($token_action)): ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="password">Nueva Contraseña:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Repetir Contraseña:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    
                    <button type="submit" class="btn-primary">Restablecer</button>
                </form>
            <?php endif; ?>
            
            <div class="auth-links">
                <a href="index.php?url=login">Volver al Login</a>
            </div>
        </div>
    </div>
</body>
</html>