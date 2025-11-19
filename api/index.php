<?php
header('Content-Type: application/json');
require_once '../env.php';
require_once '../models/Tracker.php';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

if (isset($_GET['list-clients-location'])) {
    $tracker = new Tracker($pdo);
    $locations = $tracker->getClientsLocation();
    
    $response = [];
    foreach ($locations as $location) {
        $response[] = [
            'ip' => $location['ip'],
            'latitud' => $location['latitud'],
            'longitud' => $location['longitud'],
            'accesos' => (int)$location['accesos']
        ];
    }
    
    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Invalid API endpoint']);
}
?>