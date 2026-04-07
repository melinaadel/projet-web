<?php
// ============================================================
// api/activite.php
// Permet à un client de faire une demande d'activité
// Méthode : POST
// Champs : login, password, activite_id, nb_personnes_concernes, granularite, message
// ============================================================

error_reporting(E_ALL);
ini_set('display_errors', 1);

$dataFile = "../data/data.json";
$json     = file_get_contents($dataFile);
$data     = json_decode($json, true);

$login               = trim($_POST['login'] ?? '');
$password            = trim($_POST['password'] ?? '');
$activiteId          = trim($_POST['activite_id'] ?? '');
$nbPersonnesConcernes = intval($_POST['nb_personnes_concernes'] ?? 1);
$granularite         = trim($_POST['granularite'] ?? '');
$message             = trim($_POST['message'] ?? '');

if (!$login || !$password || !$activiteId) {
    echo json_encode(["succes" => false, "message" => "❌ Données manquantes."]);
    exit;
}

// --- Vérifier le client ---
$clientTrouve = null;
foreach ($data['clients'] as $c) {
    if ($c['login'] === $login && $c['password'] === $password) {
        $clientTrouve = $c;
        break;
    }
}

if (!$clientTrouve) {
    echo json_encode(["succes" => false, "message" => "❌ Client non reconnu."]);
    exit;
}

// --- Trouver la réservation ---
$reservation = null;
foreach ($data['reservations'] as $r) {
    if ($r['id'] == $clientTrouve['reservation_id']) {
        $reservation = $r;
        break;
    }
}

if (!$reservation) {
    echo json_encode(["succes" => false, "message" => "❌ Réservation introuvable."]);
    exit;
}

// --- Vérifier que l'activité existe ---
$activiteInfo = null;
foreach ($data['activites_disponibles'] as $a) {
    if ($a['id'] === $activiteId) {
        $activiteInfo = $a;
        break;
    }
}

if (!$activiteInfo) {
    echo json_encode(["succes" => false, "message" => "❌ Activité inconnue."]);
    exit;
}

// --- Enregistrer la demande ---
$data['demandes_activites'][] = [
    "id"                    => count($data['demandes_activites']) + 1,
    "reservation_id"        => intval($clientTrouve['reservation_id']),
    "nom_client"            => $reservation['nom'],
    "activite_id"           => $activiteId,
    "activite_nom"          => $activiteInfo['nom'],
    "nb_personnes_concernes"=> $nbPersonnesConcernes,
    "granularite"           => $granularite ?: $activiteInfo['granularite'],
    "message"               => $message,
    "date_debut_sejour"     => $reservation['date_debut'],
    "date_fin_sejour"       => $reservation['date_fin'],
    "statut"                => "en_attente"
];

file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode([
    "succes"  => true,
    "message" => "✅ Demande d'activité enregistrée : " . $activiteInfo['nom']
]);
?>