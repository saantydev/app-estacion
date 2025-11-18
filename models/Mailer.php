<?php
require_once 'mp-mailer-master/mail_function.php';

class Mailer {
    public function sendWelcomeEmail($email, $nombres, $token_action) {
        $subject = "Bienvenido a App Estacion";
        $body = "
        <div style='font-family: Segoe UI, sans-serif; max-width: 600px; margin: 0 auto; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; border-radius: 20px;'>
            <div style='background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); padding: 40px; border-radius: 16px; text-align: center; border: 1px solid rgba(255,255,255,0.2);'>
                <h1 style='color: white; font-size: 2.5rem; margin-bottom: 10px; text-shadow: 0 2px 10px rgba(0,0,0,0.3);'>App Estacion</h1>
                <div style='width: 60px; height: 3px; background: linear-gradient(45deg, #ff6b6b, #4ecdc4); margin: 0 auto 30px; border-radius: 2px;'></div>
                <h2 style='color: white; margin-bottom: 20px;'>¡Bienvenido $nombres!</h2>
                <p style='color: rgba(255,255,255,0.9); font-size: 1.1rem; margin-bottom: 30px; line-height: 1.6;'>Gracias por registrarte en nuestra plataforma de monitoreo meteorologico.</p>
                <p style='color: rgba(255,255,255,0.8); margin-bottom: 30px;'>Para activar tu cuenta y comenzar a usar todas las funcionalidades:</p>
                <a href='https://mattprofe.com.ar/alumno/9895/app-estacion/index.php?url=validate/$token_action' style='display: inline-block; background: linear-gradient(135deg, #ff6b6b 0%, #4ecdc4 100%); color: white; padding: 18px 35px; text-decoration: none; border-radius: 50px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 8px 25px rgba(255,107,107,0.3); transition: all 0.3s ease;'>Activar mi cuenta</a>
                <p style='color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-top: 30px;'>Si no te registraste, puedes ignorar este email.</p>
            </div>
        </div>
        ";
        
        return $this->sendEmail($email, $subject, $body);
    }
    
    public function sendLoginNotification($email, $nombres, $clientInfo, $token) {
        $subject = "Inicio de sesion en App Estacion";
        $body = "
        <div style='font-family: Segoe UI, sans-serif; max-width: 600px; margin: 0 auto; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; border-radius: 20px;'>
            <div style='background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); padding: 40px; border-radius: 16px; text-align: center; border: 1px solid rgba(255,255,255,0.2);'>
                <h1 style='color: white; font-size: 2rem; margin-bottom: 20px;'>Inicio de Sesion</h1>
                <h2 style='color: white; margin-bottom: 20px;'>Hola $nombres</h2>
                <p style='color: rgba(255,255,255,0.9); margin-bottom: 25px;'>Se ha iniciado sesion en tu cuenta desde:</p>
                <div style='background: rgba(255,255,255,0.05); padding: 20px; border-radius: 12px; margin-bottom: 25px; text-align: left;'>
                    <p style='color: rgba(255,255,255,0.8); margin: 8px 0;'><strong>IP:</strong> {$clientInfo['ip']}</p>
                    <p style='color: rgba(255,255,255,0.8); margin: 8px 0;'><strong>Sistema:</strong> {$clientInfo['os']}</p>
                    <p style='color: rgba(255,255,255,0.8); margin: 8px 0;'><strong>Navegador:</strong> {$clientInfo['browser']}</p>
                </div>
                <p style='color: rgba(255,255,255,0.8); margin-bottom: 25px;'>Si no fuiste tu:</p>
                <a href='https://mattprofe.com.ar/alumno/9895/app-estacion/index.php?url=blocked/$token' style='display: inline-block; background: #ff6b6b; color: white; padding: 15px 30px; text-decoration: none; border-radius: 12px; font-weight: 600;'>Bloquear mi cuenta</a>
            </div>
        </div>
        ";
        
        return $this->sendEmail($email, $subject, $body);
    }
    
    public function sendInvalidPasswordAlert($email, $nombres, $clientInfo, $token) {
        $subject = "Intento de acceso con contrasena invalida";
        $body = "
        <div style='font-family: Segoe UI, sans-serif; max-width: 600px; margin: 0 auto; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; border-radius: 20px;'>
            <div style='background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); padding: 40px; border-radius: 16px; text-align: center; border: 1px solid rgba(255,255,255,0.2);'>
                <h1 style='color: white; font-size: 2rem; margin-bottom: 20px;'>Alerta de Seguridad</h1>
                <h2 style='color: white; margin-bottom: 20px;'>Hola $nombres</h2>
                <p style='color: rgba(255,255,255,0.9); margin-bottom: 25px;'>Se intento acceder a tu cuenta con una contrasena incorrecta desde:</p>
                <div style='background: rgba(255,255,255,0.05); padding: 20px; border-radius: 12px; margin-bottom: 25px; text-align: left;'>
                    <p style='color: rgba(255,255,255,0.8); margin: 8px 0;'><strong>IP:</strong> {$clientInfo['ip']}</p>
                    <p style='color: rgba(255,255,255,0.8); margin: 8px 0;'><strong>Sistema:</strong> {$clientInfo['os']}</p>
                    <p style='color: rgba(255,255,255,0.8); margin: 8px 0;'><strong>Navegador:</strong> {$clientInfo['browser']}</p>
                </div>
                <p style='color: rgba(255,255,255,0.8); margin-bottom: 25px;'>Si no fuiste tu:</p>
                <a href='https://mattprofe.com.ar/alumno/9895/app-estacion/index.php?url=blocked/$token' style='display: inline-block; background: #ff6b6b; color: white; padding: 15px 30px; text-decoration: none; border-radius: 12px; font-weight: 600;'>Bloquear mi cuenta</a>
            </div>
        </div>
        ";
        
        return $this->sendEmail($email, $subject, $body);
    }
    
    public function sendActivationConfirmation($email, $nombres) {
        $subject = "Cuenta activada exitosamente";
        $body = "
        <div style='font-family: Segoe UI, sans-serif; max-width: 600px; margin: 0 auto; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; border-radius: 20px;'>
            <div style='background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); padding: 40px; border-radius: 16px; text-align: center; border: 1px solid rgba(255,255,255,0.2);'>
                <h1 style='color: white; font-size: 2.2rem; margin-bottom: 20px; text-shadow: 0 2px 10px rgba(0,0,0,0.3);'>Cuenta Activada</h1>
                <div style='width: 60px; height: 3px; background: linear-gradient(45deg, #ff6b6b, #4ecdc4); margin: 0 auto 30px; border-radius: 2px;'></div>
                <h2 style='color: white; margin-bottom: 20px;'>Felicitaciones $nombres!</h2>
                <p style='color: rgba(255,255,255,0.9); font-size: 1.1rem; margin-bottom: 25px; line-height: 1.6;'>Tu cuenta ha sido activada exitosamente.</p>
                <p style='color: rgba(255,255,255,0.8); margin-bottom: 30px;'>Ya puedes iniciar sesion en App Estacion y acceder a todas las funcionalidades.</p>
                <a href='https://mattprofe.com.ar/alumno/9895/app-estacion/index.php?url=login' style='display: inline-block; background: linear-gradient(135deg, #4ecdc4 0%, #ff6b6b 100%); color: white; padding: 18px 35px; text-decoration: none; border-radius: 50px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 8px 25px rgba(78,205,196,0.3);'>Iniciar Sesion</a>
                <p style='color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-top: 30px;'>Bienvenido a nuestra plataforma de monitoreo meteorologico.</p>
            </div>
        </div>
        ";
        
        return $this->sendEmail($email, $subject, $body);
    }
    
    public function sendBlockedNotification($email, $nombres, $token_action) {
        $subject = "Cuenta bloqueada por seguridad";
        $body = "
        <div style='font-family: Segoe UI, sans-serif; max-width: 600px; margin: 0 auto; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; border-radius: 20px;'>
            <div style='background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); padding: 40px; border-radius: 16px; text-align: center; border: 1px solid rgba(255,255,255,0.2);'>
                <h1 style='color: white; font-size: 2rem; margin-bottom: 20px;'>Cuenta Bloqueada</h1>
                <h2 style='color: white; margin-bottom: 20px;'>Hola $nombres</h2>
                <p style='color: rgba(255,255,255,0.9); font-size: 1.1rem; margin-bottom: 25px; line-height: 1.6;'>Tu cuenta ha sido bloqueada por seguridad.</p>
                <p style='color: rgba(255,255,255,0.8); margin-bottom: 30px;'>Para desbloquear tu cuenta y restablecer tu contrasena:</p>
                <a href='https://mattprofe.com.ar/alumno/9895/app-estacion/index.php?url=reset/$token_action' style='display: inline-block; background: linear-gradient(135deg, #ff9800 0%, #ff6b6b 100%); color: white; padding: 18px 35px; text-decoration: none; border-radius: 50px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 8px 25px rgba(255,152,0,0.3);'>Cambiar Contrasena</a>
                <p style='color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-top: 30px;'>Este enlace expira en 24 horas por seguridad.</p>
            </div>
        </div>
        ";
        
        return $this->sendEmail($email, $subject, $body);
    }
    
    public function sendRecoveryEmail($email, $nombres, $token_action) {
        $subject = "Restablecimiento de contrasena";
        $body = "
        <div style='font-family: Segoe UI, sans-serif; max-width: 600px; margin: 0 auto; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; border-radius: 20px;'>
            <div style='background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); padding: 40px; border-radius: 16px; text-align: center; border: 1px solid rgba(255,255,255,0.2);'>
                <h1 style='color: white; font-size: 2rem; margin-bottom: 20px;'>Recuperar Contrasena</h1>
                <h2 style='color: white; margin-bottom: 20px;'>Hola $nombres</h2>
                <p style='color: rgba(255,255,255,0.9); font-size: 1.1rem; margin-bottom: 25px; line-height: 1.6;'>Has solicitado restablecer tu contrasena en App Estacion.</p>
                <p style='color: rgba(255,255,255,0.8); margin-bottom: 30px;'>Para continuar con el proceso de restablecimiento:</p>
                <a href='https://mattprofe.com.ar/alumno/9895/app-estacion/index.php?url=reset/$token_action' style='display: inline-block; background: linear-gradient(135deg, #2196F3 0%, #4ecdc4 100%); color: white; padding: 18px 35px; text-decoration: none; border-radius: 50px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 8px 25px rgba(33,150,243,0.3);'>Restablecer Contrasena</a>
                <p style='color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-top: 30px;'>Si no solicitaste este cambio, puedes ignorar este email.</p>
                <p style='color: rgba(255,255,255,0.6); font-size: 0.8rem; margin-top: 15px;'>Este enlace expira en 24 horas por seguridad.</p>
            </div>
        </div>
        ";
        
        return $this->sendEmail($email, $subject, $body);
    }
    
    public function sendPasswordResetConfirmation($email, $nombres, $clientInfo, $token) {
        $subject = "Contrasena restablecida exitosamente";
        $body = "
        <div style='font-family: Segoe UI, sans-serif; max-width: 600px; margin: 0 auto; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; border-radius: 20px;'>
            <div style='background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); padding: 40px; border-radius: 16px; text-align: center; border: 1px solid rgba(255,255,255,0.2);'>
                <h1 style='color: white; font-size: 2rem; margin-bottom: 20px;'>Contrasena Actualizada</h1>
                <h2 style='color: white; margin-bottom: 20px;'>Hola $nombres</h2>
                <p style='color: rgba(255,255,255,0.9); margin-bottom: 25px;'>Tu contrasena ha sido restablecida exitosamente desde:</p>
                <div style='background: rgba(255,255,255,0.05); padding: 20px; border-radius: 12px; margin-bottom: 25px; text-align: left;'>
                    <p style='color: rgba(255,255,255,0.8); margin: 8px 0;'><strong>IP:</strong> {$clientInfo['ip']}</p>
                    <p style='color: rgba(255,255,255,0.8); margin: 8px 0;'><strong>Sistema:</strong> {$clientInfo['os']}</p>
                    <p style='color: rgba(255,255,255,0.8); margin: 8px 0;'><strong>Navegador:</strong> {$clientInfo['browser']}</p>
                </div>
                <p style='color: rgba(255,255,255,0.8); margin-bottom: 25px;'>Si no fuiste tu quien realizo este cambio:</p>
                <a href='https://mattprofe.com.ar/alumno/9895/app-estacion/index.php?url=blocked/$token' style='display: inline-block; background: #ff6b6b; color: white; padding: 15px 30px; text-decoration: none; border-radius: 12px; font-weight: 600;'>Bloquear mi cuenta</a>
                <p style='color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-top: 25px;'>Ya puedes iniciar sesion con tu nueva contrasena.</p>
            </div>
        </div>
        ";
        
        return $this->sendEmail($email, $subject, $body);
    }
    
    private function sendEmail($to, $subject, $body) {
        return sendMail($to, $subject, $body);
    }
}
?>