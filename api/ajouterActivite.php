<?php
session_start();
header('Content-Type: application/json');

$cheminReservations = __DIR__ . '/../data/reservations.json';

if (!isset($_SESSION['client'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Utilisateur non connecté.'
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Méthode non autorisée.'
    ]);
    exit;
}

$nomActivite = $_POST['activite_nom'] ?? '';
$date = $_POST['date'] ?? '';
$creneau = $_POST['creneau'] ?? '';
$participants = $_POST['participants'] ?? '';
$message = $_POST['message'] ?? '';

if (!file_exists($cheminReservations)) {
    echo json_encode([
        'success' => false,
        'message' => 'Fichier des réservations introuvable.'
    ]);
    exit;
}

$contenu = file_get_contents($cheminReservations);
$reservations = json_decode($contenu, true);

if (!is_array($reservations)) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur de lecture des réservations.'
    ]);
    exit;
}

$emailClient = $_SESSION['client']['email'];
$reservationTrouvee = false;
$activiteModifiee = false;

foreach ($reservations as &$reservation) {
    if (isset($reservation['email']) && $reservation['email'] === $emailClient) {
        $reservationTrouvee = true;

        if (!isset($reservation['activites']) || !is_array($reservation['activites'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Aucune activité disponible pour cette réservation.'
            ]);
            exit;
        }

        foreach ($reservation['activites'] as &$activite) {
            if (
                isset($activite['nom']) &&
                $activite['nom'] === $nomActivite &&
                (!isset($activite['statut']) || $activite['statut'] === '')
            ) {
                $activite['date'] = $date;
                $activite['creneau'] = $creneau;
                $activite['participants'] = $participants;
                $activite['message'] = $message;
                $activite['statut'] = 'en_attente';

                $activiteModifiee = true;
                break;
            }
        }

        break;
    }
}

if (!$reservationTrouvee) {
    echo json_encode([
        'success' => false,
        'message' => 'Aucune réservation trouvée pour ce client.'
    ]);
    exit;
}

if (!$activiteModifiee) {
    echo json_encode([
        'success' => false,
        'message' => 'Activité introuvable ou déjà demandée.'
    ]);
    exit;
}

$resultat = file_put_contents(
    $cheminReservations,
    json_encode($reservations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

if ($resultat === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Impossible d’enregistrer la demande d’activité.'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'Demande d’activité mise à jour avec succès.'
]);