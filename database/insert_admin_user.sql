-- Insertar usuario administrador
INSERT INTO app_estacion__usuarios (token, email, nombres, contraseña, activo, bloqueado, recupero, add_date, active_date) 
VALUES (
    'admin_token_12345678901234567890123456789012',
    'admin-estacion@app.com',
    'Administrador',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    1,
    0,
    0,
    NOW(),
    NOW()
);