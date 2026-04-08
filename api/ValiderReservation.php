<?php
header('Content-Type: application/json');

// 📁 chemins
$cheminReservations = __DIR__ . '/../data/reservations.json';
$cheminClients = __DIR__ . '/../data/clients.json';

// 📥 lire fichiers
$reservations = json_decode(file_get_contents($cheminReservations), true);

// ⚠️ si clients.json n'existe pas → tableau vide
if (file_exists($cheminClients)) {
    $clients = json_decode(file_get_contents($cheminClients), true);
    if (!$clients) $clients = [];
} else {
    $clients = [];
}

// 📌 id envoyé
$id = $_POST['id'] ?? null;

if (!$id) {
    echo json_encode(["success" => false, "error" => "ID manquant"]);
    exit;
}

$clientAjoute = false;

// 🔄 boucle
foreach ($reservations as &$r) {

    if ($r['id'] == $id) {

        // ✅ 1. passer en validée
        $r['statut'] = 'validee';

        // ✅ 2. ajouter dans clients.json
        $clients[] = [
            "id" => $r['id'],
            "nom" => $r['nom'],
            "email" => $r['email'],
            "date_debut" => $r['date_debut'],
            "date_fin" => $r['date_fin'],
            "nb_personnes" => $r['nb_personnes'],
            "chambre" => $r['chambre'],
            "activites" => $r['activites'] ?? [],
            "prestations" => [],
            "arrhes" => 0,
            "reduction" => 0
        ];

        $clientAjoute = true;
    }
}

// ❌ si pas trouvé
if (!$clientAjoute) {
    echo json_encode(["success" => false, "error" => "ID non trouvé"]);
    exit;
}

// 💾 sauvegarde
file_put_contents($cheminReservations, json_encode($reservations, JSON_PRETTY_PRINT));
file_put_contents($cheminClients, json_encode($clients, JSON_PRETTY_PRINT));

echo json_encode(["success" => true]);