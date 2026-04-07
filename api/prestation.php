<?php
// ============================================================
// api/prestation.php
// Permet à un client connecté de commander une prestation
// Méthode : POST
// Champs : login, password, prestation_id
// ============================================================

error_reporting(E_ALL);
ini_set('display_errors', 1);

$dataFile = "../data/data.json";
$json     = file_get_contents($dataFile);
$data     = json_decode($json, true);

$login        = trim($_POST['login'] ?? '');
$password     = trim($_POST['password'] ?? '');
$prestationId = trim($_POST['prestation_id'] ?? '');

if (!$login || !$password || !$prestationId) {
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

// --- Vérifier que la prestation existe ---
$prestationInfo = null;
foreach ($data['prestations_disponibles'] as $p) {
    if ($p['id'] === $prestationId) {
        $prestationInfo = $p;
        break;
    }
}

if (!$prestationInfo) {
    echo json_encode(["succes" => false, "message" => "❌ Prestation inconnue."]);
    exit;
}

// --- Ajouter la prestation ---
$data['prestations'][] = [
    "reservation_id" => intval($clientTrouve['reservation_id']),
    "prestation_id"  => $prestationId,
    "nom"            => $prestationInfo['nom'],
    "prix"           => $prestationInfo['prix']
];

file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// --- Retourner les prestations mises à jour du client ---
$mesPrestations = [];
foreach ($data['prestations'] as $p) {
    if ($p['reservation_id'] == $clientTrouve['reservation_id']) {
        $mesPrestations[] = $p;
    }
}

echo json_encode([
    "succes"      => true,
    "message"     => "✅ Prestation ajoutée : " . $prestationInfo['nom'],
    "prestations" => $mesPrestations
]);
?>