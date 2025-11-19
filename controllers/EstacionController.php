<?php
require_once 'controllers/BaseController.php';
require_once 'models/Tracker.php';

class EstacionController extends BaseController {
    private $tracker;
    
    public function __construct($database = null) {
        if ($database) {
            $this->tracker = new Tracker($database);
        }
    }
    
    public function landing() {
        $this->render('landing', [
            'title' => 'App Estación - Inicio'
        ]);
    }

    public function panel() {
        // Trackear cliente
        if ($this->tracker) {
            $this->tracker->trackClient();
        }
        
        $this->render('panel', [
            'title' => 'Panel de Estaciones'
        ]);
    }

    public function detalle($chipid) {
        if (!$this->isLoggedIn()) {
            header('Location: index.php?url=login');
            exit;
        }
        
        $this->render('detalle', [
            'title' => 'Detalle de Estación',
            'chipid' => $chipid
        ]);
    }
    
    private function isLoggedIn() {
        return isset($_SESSION['user_id']) && isset($_SESSION['user_token']);
    }
}
?>