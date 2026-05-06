<?php
// contador.php - Incrementa contador de descargas (simulado)
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recurso_id = $_POST['recurso_id'] ?? 0;
    
    // En un sistema real, aquí se actualizaría la base de datos
    // Por ahora solo registramos en log de sesión
    if (!isset($_SESSION['descargas'])) {
        $_SESSION['descargas'] = [];
    }
    
    if (!in_array($recurso_id, $_SESSION['descargas'])) {
        $_SESSION['descargas'][] = $recurso_id;
    }
    
    echo json_encode(['success' => true, 'message' => 'Descarga registrada']);
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>