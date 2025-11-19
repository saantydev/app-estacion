<?php
require_once 'BaseController.php';
require_once 'models/User.php';
require_once 'models/Mailer.php';

class AuthController extends BaseController {
    private $user;
    private $mailer;
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
        $this->user = new User($database);
        $this->mailer = new Mailer();
    }
    
    public function login() {
        if ($this->isLoggedIn()) {
            header('Location: index.php?url=panel');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $userData = $this->user->findByEmail($email);
            
            if (!$userData) {
                $this->render('login', ['error' => 'Credenciales no válidas']);
                return;
            }
            
            if (!$this->user->verifyPassword($password, $userData['contraseña'])) {
                $clientInfo = $this->user->getClientInfo();
                $this->mailer->sendInvalidPasswordAlert($email, $userData['nombres'], $clientInfo, $userData['token']);
                $this->render('login', ['error' => 'Credenciales no válidas']);
                return;
            }
            
            if (!$userData['activo']) {
                $this->render('login', ['error' => 'Su usuario aún no se ha validado, revise su casilla de correo']);
                return;
            }
            
            if ($userData['bloqueado'] || $userData['recupero']) {
                $this->render('login', ['error' => 'Su usuario está bloqueado, revise su casilla de correo']);
                return;
            }
            
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_token'] = $userData['token'];
            
            $clientInfo = $this->user->getClientInfo();
            $this->mailer->sendLoginNotification($email, $userData['nombres'], $clientInfo, $userData['token']);
            
            header('Location: index.php?url=panel');
            exit;
        }
        
        $this->render('login');
    }
    
    public function register() {
        if ($this->isLoggedIn()) {
            header('Location: index.php?url=panel');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $nombres = $_POST['nombres'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            if ($password !== $confirmPassword) {
                $this->render('register', ['error' => 'Las contraseñas no coinciden']);
                return;
            }
            
            if ($this->user->findByEmail($email)) {
                $this->render('register', ['error' => 'El email ya corresponde a un usuario', 'show_login' => true]);
                return;
            }
            
            if ($this->user->create($email, $nombres, $password)) {
                $userData = $this->user->findByEmail($email);
                $this->mailer->sendWelcomeEmail($email, $nombres, $userData['token_action']);
                $this->render('register', ['success' => 'Usuario registrado. Revisa tu correo para activar tu cuenta.']);
            } else {
                $this->render('register', ['error' => 'Error al registrar usuario']);
            }
            return;
        }
        
        $this->render('register');
    }
    
    public function validate($token_action) {
        if ($this->isLoggedIn()) {
            header('Location: index.php?url=panel');
            exit;
        }
        
        $userData = $this->user->findByTokenAction($token_action);
        
        if (!$userData || $userData['activo']) {
            $this->render('message', ['error' => 'El token no corresponde a un usuario']);
            return;
        }
        
        if ($this->user->activate($token_action)) {
            $this->mailer->sendActivationConfirmation($userData['email'], $userData['nombres']);
            header('Location: index.php?url=login');
            exit;
        }
        
        $this->render('message', ['error' => 'Error al activar usuario']);
    }
    
    public function blocked($token) {
        $userData = $this->user->findByToken($token);
        
        if (!$userData) {
            $this->render('message', ['error' => 'El token no corresponde a un usuario']);
            return;
        }
        
        if ($this->user->block($token)) {
            $newUserData = $this->user->findByToken($token);
            $this->mailer->sendBlockedNotification($userData['email'], $userData['nombres'], $newUserData['token_action']);
            $this->render('message', ['message' => 'Usuario bloqueado, revise su correo electrónico']);
        } else {
            $this->render('message', ['error' => 'Error al bloquear usuario']);
        }
    }
    
    public function recovery() {
        if ($this->isLoggedIn()) {
            header('Location: index.php?url=panel');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $userData = $this->user->findByEmail($email);
            
            if (!$userData) {
                $this->render('recovery', ['error' => 'El email no se encuentra registrado', 'show_register' => true]);
                return;
            }
            
            $token_action = $this->user->setRecovery($email);
            if ($token_action) {
                $this->mailer->sendRecoveryEmail($email, $userData['nombres'], $token_action);
                $this->render('recovery', ['success' => 'Se ha enviado un email para restablecer tu contraseña']);
            } else {
                $this->render('recovery', ['error' => 'Error al procesar solicitud']);
            }
            return;
        }
        
        $this->render('recovery');
    }
    
    public function reset($token_action) {
        if ($this->isLoggedIn()) {
            header('Location: index.php?url=panel');
            exit;
        }
        
        $userData = $this->user->findByTokenAction($token_action);
        
        if (!$userData) {
            $this->render('message', ['error' => 'Token invalido o expirado']);
            return;
        }
        
        if (!$userData['bloqueado'] && !$userData['recupero']) {
            $this->render('message', ['error' => 'Token invalido o expirado']);
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            if ($password !== $confirmPassword) {
                $this->render('reset', ['error' => 'Las contraseñas no coinciden', 'token_action' => $token_action]);
                return;
            }
            
            if ($this->user->resetPassword($token_action, $password)) {
                $clientInfo = $this->user->getClientInfo();
                $this->mailer->sendPasswordResetConfirmation($userData['email'], $userData['nombres'], $clientInfo, $userData['token']);
                header('Location: index.php?url=login');
                exit;
            } else {
                $this->render('reset', ['error' => 'Error al restablecer contraseña', 'token_action' => $token_action]);
            }
            return;
        }
        
        $this->render('reset', ['token_action' => $token_action]);
    }
    
    public function logout() {
        // Si es admin, redirigir a admin login
        if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true) {
            unset($_SESSION['admin_logged']);
            unset($_SESSION['admin_username']);
            header('Location: index.php?url=administrator');
            exit;
        }
        
        // Si es usuario normal
        session_destroy();
        header('Location: index.php?url=login');
        exit;
    }
    
    private function isLoggedIn() {
        return isset($_SESSION['user_id']) && isset($_SESSION['user_token']);
    }
}
?>