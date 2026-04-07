<?php
// ============================================================
// api/login.php
// Vérifie les identifiants du client et retourne ses infos
// Méthode : POST
// Champs : login, password
// Retourne : JSON avec les infos du client + sa réservation
// ============================================================

error_reporting(E_ALL);
ini_set('display_errors', 1);

// --- 1. Lire les données ---
$dataFile = "../data/data.json";
$json     = file_get_contents($dataFile);
$data     = json_decode($json, true);

$login    = trim($_POST['login'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!$login || !$password) {
    echo json_encode(["succes" => false, "message" => "❌ Veuillez remplir tous les champs."]);
    exit;
}

// --- 2. Chercher le client ---
foreach ($data['clients'] as $client) {

    if ($client['login'] === $login && $client['password'] === $password) {

        // --- 3. Trouver sa réservation ---
        $reservation = null;
        foreach ($data['reservations'] as $r) {
            if ($r['id'] == $client['reservation_id']) {
                $reservation = $r;
                break;
            }
        }

        if (!$reservation) {
            echo json_encode(["succes" => false, "message" => "❌ Réservation introuvable."]);
            exit;
        }

        // --- 4. Récupérer ses prestations commandées ---
        $mesPrestations = [];
        foreach ($data['prestations'] as $p) {
            if ($p['reservation_id'] == $reservation['id']) {
                $mesPrestations[] = $p;
            }
        }

        // --- 5. Récupérer ses activités prévues ---
        $mesActivites = [];
        foreach ($data['activites_prevues'] as $a) {
            if (in_array($reservation['id'], $a['reservation_ids'])) {
                $mesActivites[] = $a;
            }
        }

        // --- 6. Retourner toutes les infos en JSON ---
        echo json_encode([
            "succes"       => true,
            "nom"          => $reservation['nom'],
            "email"        => $login,
            "reservation"  => $reservation,
            "prestations"  => $mesPrestations,
            "activites"    => $mesActivites,
            "prestations_disponibles" => $data['prestations_disponibles']
        ]);
        exit;
    }
}

// --- 7. Identifiants incorrects ---
echo json_encode(["succes" => false, "message" => "❌ Email ou mot de passe incorrect."]);
?>