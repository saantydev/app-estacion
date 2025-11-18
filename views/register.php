<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - App Estación</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-form">
            <h2>Registrarse</h2>
            
            <?php if (isset($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
                <?php if (isset($show_login)): ?>
                    <a href="index.php?url=login" class="btn-secondary">Iniciar Sesión</a>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input type="text" id="nombres" name="nombres" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Repetir Contraseña:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <button type="submit" class="btn-primary">Registrarse</button>
            </form>
            
            <div class="auth-links">
                <a href="index.php?url=login">¿Ya tienes una cuenta? Iniciar Sesión</a>
            </div>
        </div>
    </div>
</body>
</html>