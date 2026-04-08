<?php
header('Content-Type: application/json');

$cheminFichier = __DIR__ . '/../data/reservations.json';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Méthode non autorisée.'
    ]);
    exit;
}

$prixChambres = [
    "Nuit Étoilée" => 120,
    "Sensorielle" => 140,
    "Silence Absolu" => 160,
    "Suite Lucide" => 220
];

$prixActivites = [
    "Méditation guidée" => 20,
    "Yoga doux" => 25,
    "Observation des étoiles" => 30,
    "Initiation au rêve lucide" => 35,
    "Sortie en bateau" => 50,
    "Match de tennis" => 40
];

$nom = $_POST['nom'] ?? '';
$email = $_POST['email'] ?? '';
$dateDebut = $_POST['date_debut'] ?? '';
$dateFin = $_POST['date_fin'] ?? '';
$nbPersonnes = $_POST['nb_personnes'] ?? '';
$chambre = $_POST['chambre'] ?? '';
$message = $_POST['message'] ?? '';
$activites = $_POST['activites'] ?? [];

$activitesFormatees = [];
foreach ($activites as $activite) {
    $activitesFormatees[] = [
        'nom' => $activite,
        'prix' => $prixActivites[$activite] ?? 0
    ];
}

if (!file_exists($cheminFichier)) {
    file_put_contents($cheminFichier, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$contenu = file_get_contents($cheminFichier);
$reservations = json_decode($contenu, true);

if (!is_array($reservations)) {
    $reservations = [];
}

$nouvelId = 1;
if (!empty($reservations)) {
    $ids = array_column($reservations, 'id');
    $nouvelId = max($ids) + 1;
}

$nouvelleReservation = [
    'id' => $nouvelId,
    'nom' => $nom,
    'email' => $email,
    'date_debut' => $dateDebut,
    'date_fin' => $dateFin,
    'nb_personnes' => (int)$nbPersonnes,
    'chambre' => $chambre,
    'prix_chambre' => $prixChambres[$chambre] ?? 0,
    'activites' => $activitesFormatees,
    'message' => $message,
    'prestations' => [],
    'statut' => 'en_attente'
];

$reservations[] = $nouvelleReservation;

$resultat = file_put_contents(
    $cheminFichier,
    json_encode($reservations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

if ($resultat === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Impossible d’enregistrer la réservation.'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'Votre demande de réservation a bien été enregistrée.'
]);