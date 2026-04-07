<?php
session_start();
header('Content-Type: application/json');

$cheminReservations = __DIR__ . '/../data/reservations.json';

if (!isset($_SESSION['client'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Utilisateur non connecté'
    ]);
    exit;
}

if (!file_exists($cheminReservations)) {
    echo json_encode([
        'success' => false,
        'message' => 'Fichier des réservations introuvable'
    ]);
    exit;
}

$contenu = file_get_contents($cheminReservations);
$reservations = json_decode($contenu, true);

if (!is_array($reservations)) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur de lecture des réservations'
    ]);
    exit;
}

$emailClient = $_SESSION['client']['email'];
$reservationClient = null;

foreach ($reservations as $reservation) {
    if (isset($reservation['email']) && $reservation['email'] === $emailClient) {
        $reservationClient = $reservation;
        break;
    }
}

if ($reservationClient === null) {
    echo json_encode([
        'success' => false,
        'message' => 'Aucune réservation trouvée pour ce client'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'reservation' => $reservationClient
]);