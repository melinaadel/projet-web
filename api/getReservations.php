<?php
header('Content-Type: application/json');

$cheminReservations = __DIR__ . '/../data/reservations.json';

if (!file_exists($cheminReservations)) {
    echo json_encode([
        'success' => true,
        'reservations' => []
    ]);
    exit;
}

$contenu = file_get_contents($cheminReservations);
$reservations = json_decode($contenu, true);

if (!is_array($reservations)) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur JSON'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'reservations' => $reservations
]);