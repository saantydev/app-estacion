<?php
class Tracker {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function generateToken() {
        return bin2hex(random_bytes(32));
    }
    
    public function getClientIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
    
    public function getLocationData($ip) {
        $url = "http://ipwho.is/$ip";
        $response = @file_get_contents($url);
        
        if ($response === false) {
            return null;
        }
        
        return json_decode($response, true);
    }
    
    public function trackClient() {
        $ip = $this->getClientIP();
        $token = $this->generateToken();
        $locationData = $this->getLocationData($ip);
        
        $latitud = $locationData['latitude'] ?? null;
        $longitud = $locationData['longitude'] ?? null;
        $pais = $locationData['country'] ?? null;
        
        $navegador = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
        $sistema = $this->getOS();
        
        $stmt = $this->db->prepare("INSERT INTO app_estacion__tracker (token, ip, latitud, longitud, pais, navegador, sistema) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$token, $ip, $latitud, $longitud, $pais, $navegador, $sistema]);
    }
    
    public function getClientsLocation() {
        $stmt = $this->db->prepare("
            SELECT ip, latitud, longitud, COUNT(*) as accesos 
            FROM app_estacion__tracker 
            WHERE latitud IS NOT NULL AND longitud IS NOT NULL 
            GROUP BY ip, latitud, longitud
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalClients() {
        $stmt = $this->db->prepare("SELECT COUNT(DISTINCT ip) as total FROM app_estacion__tracker");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    private function getOS() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        if (preg_match('/Windows/i', $user_agent)) return 'Windows';
        if (preg_match('/Mac/i', $user_agent)) return 'Mac';
        if (preg_match('/Linux/i', $user_agent)) return 'Linux';
        if (preg_match('/Android/i', $user_agent)) return 'Android';
        if (preg_match('/iOS/i', $user_agent)) return 'iOS';
        return 'Unknown';
    }
}
?>