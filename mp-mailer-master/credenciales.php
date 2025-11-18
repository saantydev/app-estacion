<?php

	/*
		Configuración del correo del remitente
		preparado para gmail
	*/

	// OPCIÓN 1: Gmail con contraseña de aplicación
	define('REMITENTE', 'saantydev@gmail.com');
	define('NOMBRE', 'app estacion');
	define('PASSWORD', 'fjvx dmin fbob nkrx'); // Contraseña de aplicación
	define('HOST', 'smtp.gmail.com');
	define('PORT', '587');
	define('SMTP_AUTH', true);
	define('SMTP_SECURE', 'tls');

	// OPCIÓN 2: Descomenta para usar Mailtrap (para pruebas)
	/*
	define('REMITENTE', 'test@example.com');
	define('NOMBRE', 'App Estación');
	define('PASSWORD', 'tu-password-mailtrap');
	define('HOST', 'smtp.mailtrap.io');
	define('PORT', '2525');
	define('SMTP_AUTH', true);
	define('SMTP_SECURE', 'tls');
	*/

 ?>