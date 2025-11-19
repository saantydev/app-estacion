<?php
class User {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function generateToken() {
        return bin2hex(random_bytes(32));
    }
    
    public function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM app_estacion__usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findByToken($token) {
        $stmt = $this->db->prepare("SELECT * FROM app_estacion__usuarios WHERE token = ?");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findByTokenAction($token_action) {
        $stmt = $this->db->prepare("SELECT * FROM app_estacion__usuarios WHERE token_action = ?");
        $stmt->execute([$token_action]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($email, $nombres, $password) {
        $token = $this->generateToken();
        $token_action = $this->generateToken();
        $hashedPassword = $this->hashPassword($password);
        
        $stmt = $this->db->prepare("INSERT INTO app_estacion__usuarios (token, email, nombres, contraseña, token_action) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$token, $email, $nombres, $hashedPassword, $token_action]);
    }
    
    public function activate($token_action) {
        $stmt = $this->db->prepare("UPDATE app_estacion__usuarios SET activo = 1, token_action = NULL, active_date = NOW() WHERE token_action = ?");
        return $stmt->execute([$token_action]);
    }
    
    public function block($token) {
        $token_action = $this->generateToken();
        $stmt = $this->db->prepare("UPDATE app_estacion__usuarios SET bloqueado = 1, token_action = ?, blocked_date = NOW() WHERE token = ?");
        return $stmt->execute([$token_action, $token]);
    }
    
    public function setRecovery($email) {
        $token_action = $this->generateToken();
        $stmt = $this->db->prepare("UPDATE app_estacion__usuarios SET recupero = 1, token_action = ?, recover_date = NOW() WHERE email = ?");
        if ($stmt->execute([$token_action, $email])) {
            return $token_action;
        }
        return false;
    }
    
    public function resetPassword($token_action, $newPassword) {
        $hashedPassword = $this->hashPassword($newPassword);
        $stmt = $this->db->prepare("UPDATE app_estacion__usuarios SET contraseña = ?, token_action = NULL, bloqueado = 0, recupero = 0 WHERE token_action = ?");
        return $stmt->execute([$hashedPassword, $token_action]);
    }
    
    public function isActive($user) {
        return $user['activo'] == 1 && $user['bloqueado'] == 0 && $user['recupero'] == 0;
    }
    
    public function getClientInfo() {
        return [
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'Unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'os' => $this->getOS(),
            'browser' => $this->getBrowser()
        ];
    }
    
    private function getOS() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/Windows/i', $user_agent)) return 'Windows';
        if (preg_match('/Mac/i', $user_agent)) return 'Mac';
        if (preg_match('/Linux/i', $user_agent)) return 'Linux';
        return 'Unknown';
    }
    
    private function getBrowser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/Chrome/i', $user_agent)) return 'Chrome';
        if (preg_match('/Firefox/i', $user_agent)) return 'Firefox';
        if (preg_match('/Safari/i', $user_agent)) return 'Safari';
        if (preg_match('/Edge/i', $user_agent)) return 'Edge';
        return 'Unknown';
    }
}
?>