<?php
// ============================================================
// api/facture.php
// Calcule la facture d'un client OU permet à l'admin d'ajouter arrhes/réduction
// Méthode : POST
// Champs (client)  : login, password
// Champs (admin)   : action="arrhes"|"reduction", reservation_id, montant|taux
// ============================================================

error_reporting(E_ALL);
ini_set('display_errors', 1);

$dataFile = "../data/data.json";
$json     = file_get_contents($dataFile);
$data     = json_decode($json, true);

$action = trim($_POST['action'] ?? 'facture');

// ============================================================
// ACTION ADMIN : ajouter des arrhes
// ============================================================
if ($action === 'arrhes') {
    $adminLogin    = trim($_POST['admin_login'] ?? '');
    $adminPassword = trim($_POST['admin_password'] ?? '');
    $reservationId = intval($_POST['reservation_id'] ?? 0);
    $montant       = floatval($_POST['montant'] ?? 0);

    // Vérifier admin
    if ($adminLogin !== $data['admin']['login'] || $adminPassword !== $data['admin']['password']) {
        echo json_encode(["succes" => false, "message" => "❌ Accès refusé."]);
        exit;
    }

    foreach ($data['reservations'] as &$r) {
        if ($r['id'] == $reservationId) {
            $r['arrhes'] = $montant;
            file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo json_encode(["succes" => true, "message" => "✅ Arrhes de {$montant}€ enregistrées."]);
            exit;
        }
    }
    echo json_encode(["succes" => false, "message" => "❌ Réservation introuvable."]);
    exit;
}

// ============================================================
// ACTION ADMIN : appliquer une réduction
// ============================================================
if ($action === 'reduction') {
    $adminLogin    = trim($_POST['admin_login'] ?? '');
    $adminPassword = trim($_POST['admin_password'] ?? '');
    $reservationId = intval($_POST['reservation_id'] ?? 0);
    $taux          = intval($_POST['taux'] ?? 0); // 10, 20 ou 50

    if ($adminLogin !== $data['admin']['login'] || $adminPassword !== $data['admin']['password']) {
        echo json_encode(["succes" => false, "message" => "❌ Accès refusé."]);
        exit;
    }

    if (!in_array($taux, [10, 20, 50])) {
        echo json_encode(["succes" => false, "message" => "❌ Taux invalide (10, 20 ou 50)."]);
        exit;
    }

    foreach ($data['reservations'] as &$r) {
        if ($r['id'] == $reservationId) {
            $r['reduction'] = $taux;
            file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo json_encode(["succes" => true, "message" => "✅ Réduction de -{$taux}% appliquée."]);
            exit;
        }
    }
    echo json_encode(["succes" => false, "message" => "❌ Réservation introuvable."]);
    exit;
}

// ============================================================
// ACTION CLIENT : calculer la facture
// ============================================================
$login    = trim($_POST['login'] ?? '');
$password = trim($_POST['password'] ?? '');

// Vérifier client
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

// Trouver la réservation
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

// --- Calcul du nombre de nuits ---
$dateDebut  = new DateTime($reservation['date_debut']);
$dateFin    = new DateTime($reservation['date_fin']);
$nbNuits    = $dateDebut->diff($dateFin)->days;

// --- Prix par nuit par personne ---
$prixNuit   = 80; // 80€ par nuit par personne
$totalNuits = $nbNuits * $reservation['nb_personnes'] * $prixNuit;

// --- Prestations commandées ---
$lignesPrestations = [];
$totalPrestations  = 0;
foreach ($data['prestations'] as $p) {
    if ($p['reservation_id'] == $reservation['id']) {
        $lignesPrestations[] = $p;
        $totalPrestations   += $p['prix'];
    }
}

// --- Appliquer réduction sur les prestations ---
$reduction       = $reservation['reduction'] ?? 0;
$montantReduction = 0;
if ($reduction > 0) {
    $montantReduction = $totalPrestations * $reduction / 100;
    $totalPrestations -= $montantReduction;
}

// --- Arrhes (ligne négative) ---
$arrhes = $reservation['arrhes'] ?? 0;

// --- Total final ---
$total = $totalNuits + $totalPrestations - $arrhes;

echo json_encode([
    "succes"            => true,
    "nom"               => $reservation['nom'],
    "nb_nuits"          => $nbNuits,
    "nb_personnes"      => $reservation['nb_personnes'],
    "prix_nuit"         => $prixNuit,
    "total_nuits"       => $totalNuits,
    "prestations"       => $lignesPrestations,
    "total_prestations_brut" => $totalPrestations + $montantReduction,
    "reduction_pct"     => $reduction,
    "montant_reduction" => $montantReduction,
    "total_prestations" => $totalPrestations,
    "arrhes"            => $arrhes,
    "total"             => $total
]);
?>