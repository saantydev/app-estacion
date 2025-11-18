<?php
require_once 'controllers/BaseController.php';

class EstacionController extends BaseController {
    
    public function landing() {
        $this->render('landing', [
            'title' => 'App Estación - Inicio'
        ]);
    }

    public function panel() {
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