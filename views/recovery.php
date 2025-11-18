<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - App Estación</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-form">
            <h2>Recuperar Contraseña</h2>
            
            <?php if (isset($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
                <?php if (isset($show_register)): ?>
                    <a href="index.php?url=register" class="btn-secondary">Registrarse</a>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="success"><?= htmlspecialchars($success) ?></div>
            <?php else: ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <button type="submit" class="btn-primary">Enviar</button>
                </form>
            <?php endif; ?>
            
            <div class="auth-links">
                <a href="index.php?url=login">Volver al Login</a>
            </div>
        </div>
    </div>
</body>
</html>