<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dataFile = "../data/data.json";

$json = file_get_contents($dataFile);
$data = json_decode($json, true);

$id = $_POST['id'] ?? null;

if (!$id) {
    echo "❌ ID manquant";
    exit;
}

// chercher réservation
foreach ($data['reservations'] as &$r) {

    if ($r['id'] == $id) {

        // ✅ changer statut
        $r['statut'] = "validee";

        // 🔐 créer compte
        $login = $r['email'];

        $password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 8);

        $data['clients'][] = [
            "login" => $login,
            "password" => $password,
            "reservation_id" => $id
        ];

        // 💾 sauvegarder
        file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

        echo "✅ Réservation validée !

Login : $login
Mot de passe : $password";

        exit;
    }
}

echo "❌ Réservation introuvable";