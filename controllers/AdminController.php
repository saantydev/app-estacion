<?php
require_once 'BaseController.php';
require_once 'models/User.php';
require_once 'models/Tracker.php';

class AdminController extends BaseController {
    private $user;
    private $tracker;
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
        $this->user = new User($database);
        $this->tracker = new Tracker($database);
    }
    
    public function administrator() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if ($username === 'admin-estacion' && $password === 'admin1234') {
                $_SESSION['admin_logged'] = true;
                header('Location: index.php?url=administrator');
                exit;
            } else {
                $this->render('admin_login', ['error' => 'Credenciales incorrectas']);
                return;
            }
        }
        
        if (!$this->isAdminLoggedIn()) {
            $this->render('admin_login');
            return;
        }
        
        $totalUsers = $this->getTotalUsers();
        $totalClients = $this->tracker->getTotalClients();
        
        $this->render('administrator', [
            'total_users' => $totalUsers,
            'total_clients' => $totalClients
        ]);
    }
    
    public function map() {
        if (!$this->isAdminLoggedIn()) {
            header('Location: index.php?url=panel');
            exit;
        }
        
        $this->render('map');
    }
    
    public function adminLogout() {
        unset($_SESSION['admin_logged']);
        header('Location: index.php?url=administrator');
        exit;
    }
    
    private function isAdminLoggedIn() {
        return isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true;
    }
    
    private function getTotalUsers() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM app_estacion__usuarios");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
?>