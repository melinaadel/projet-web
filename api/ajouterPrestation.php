<?php
session_start();
header('Content-Type: application/json');

$cheminReservations = __DIR__ . '/../data/reservations.json';

$prixPrestations = [
    "Navette" => 25,
    "Petit déjeuner" => 15,
    "Dîner" => 30,
    "Massage" => 60
];

if (!isset($_SESSION['client'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté']);
    exit;
}

$nomPrestation = $_POST['prestation'] ?? '';

if (!file_exists($cheminReservations)) {
    echo json_encode(['success' => false, 'message' => 'Fichier introuvable']);
    exit;
}

$reservations = json_decode(file_get_contents($cheminReservations), true);
$emailClient = $_SESSION['client']['email'];

foreach ($reservations as &$reservation) {
    if (isset($reservation['email']) && $reservation['email'] === $emailClient) {
        if (!isset($reservation['prestations']) || !is_array($reservation['prestations'])) {
            $reservation['prestations'] = [];
        }

        $reservation['prestations'][] = [
            'nom' => $nomPrestation,
            'prix' => $prixPrestations[$nomPrestation] ?? 0
        ];

        file_put_contents($cheminReservations, json_encode($reservations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        echo json_encode(['success' => true, 'message' => 'Prestation ajoutée']);
        exit;
    }
}

echo json_encode(['success' => false, 'message' => 'Réservation introuvable']);