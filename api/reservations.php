<?php
// ============================================================
// api/reservations.php
// Reçoit une demande de réservation et la sauvegarde dans data.json
// Méthode : POST
// Champs : nom, email, date_debut, date_fin, nb_personnes, activites_souhaitees
// ============================================================

error_reporting(E_ALL);
ini_set('display_errors', 1);

// --- 1. Récupérer les données POST ---
$nom                 = trim($_POST['nom'] ?? '');
$email               = trim($_POST['email'] ?? '');
$date_debut          = $_POST['date_debut'] ?? '';
$date_fin            = $_POST['date_fin'] ?? '';
$nb_personnes        = $_POST['nb_personnes'] ?? '';
$activites_souhaitees = trim($_POST['activites_souhaitees'] ?? '');

// --- 2. Vérifications ---
if (!$nom || !$email || !$date_debut || !$date_fin || !$nb_personnes) {
    echo "❌ Tous les champs obligatoires doivent être remplis.";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "❌ Adresse email invalide.";
    exit;
}

if ($date_fin <= $date_debut) {
    echo "❌ La date de fin doit être après la date de début.";
    exit;
}

if (intval($nb_personnes) < 1) {
    echo "❌ Le nombre de personnes doit être au moins 1.";
    exit;
}

// --- 3. Lire le fichier JSON ---
$dataFile = "../data/data.json";

$json = file_get_contents($dataFile);
$data = json_decode($json, true);

// --- 4. Vérifier que l'email n'a pas déjà une réservation en attente ---
foreach ($data['reservations'] as $r) {
    if ($r['email'] === $email && $r['statut'] === 'en_attente') {
        echo "⚠️ Une réservation est déjà en attente pour cet email.";
        exit;
    }
}

// --- 5. Créer la nouvelle réservation ---
$id = count($data['reservations']) + 1;

$data['reservations'][] = [
    "id"                   => $id,
    "nom"                  => $nom,
    "email"                => $email,
    "date_debut"           => $date_debut,
    "date_fin"             => $date_fin,
    "nb_personnes"         => intval($nb_personnes),
    "activites_souhaitees" => $activites_souhaitees,
    "statut"               => "en_attente",
    "arrhes"               => 0,
    "reduction"            => 0
];

// --- 6. Sauvegarder dans le JSON ---
file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "✅ Votre réservation a bien été enregistrée ! Vous recevrez un email de confirmation.";
?>