<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode([
        "success" => false,
        "message" => "Accès refusé."
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "success" => false,
        "message" => "Méthode non autorisée."
    ]);
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$action = isset($_POST['action']) ? trim($_POST['action']) : '';

if ($id <= 0 || !in_array($action, ['accepter', 'refuser'])) {
    echo json_encode([
        "success" => false,
        "message" => "Paramètres invalides."
    ]);
    exit;
}

$fichierReservations = __DIR__ . '/../data/reservations.json';
$fichierClients = __DIR__ . '/../data/clients.json';

if (!file_exists($fichierReservations)) {
    echo json_encode([
        "success" => false,
        "message" => "Fichier reservations.json introuvable."
    ]);
    exit;
}

$reservations = json_decode(file_get_contents($fichierReservations), true);

if (!is_array($reservations)) {
    echo json_encode([
        "success" => false,
        "message" => "Format de reservations.json invalide."
    ]);
    exit;
}

$reservationTrouvee = false;
$reservationSelectionnee = null;

foreach ($reservations as &$reservation) {
    if (isset($reservation['id']) && intval($reservation['id']) === $id) {
        $reservationTrouvee = true;

        if ($action === 'accepter') {
            $reservation['statut'] = 'acceptee';
        } else {
            $reservation['statut'] = 'refusee';
        }

        $reservationSelectionnee = $reservation;
        break;
    }
}

if (!$reservationTrouvee || $reservationSelectionnee === null) {
    echo json_encode([
        "success" => false,
        "message" => "Réservation introuvable."
    ]);
    exit;
}

if ($action === 'refuser') {
    $ok = file_put_contents(
        $fichierReservations,
        json_encode($reservations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );

    if ($ok === false) {
        echo json_encode([
            "success" => false,
            "message" => "Erreur lors de l'enregistrement de la réservation."
        ]);
        exit;
    }

    echo json_encode([
        "success" => true,
        "message" => "Réservation refusée."
    ]);
    exit;
}

/* ============================
   SI LA RÉSERVATION EST ACCEPTÉE
   ============================ */

if (!file_exists($fichierClients)) {
    file_put_contents($fichierClients, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$clients = json_decode(file_get_contents($fichierClients), true);

if (!is_array($clients)) {
    $clients = [];
}

$nom = isset($reservationSelectionnee['nom']) ? $reservationSelectionnee['nom'] : '';
$email = isset($reservationSelectionnee['email']) ? $reservationSelectionnee['email'] : '';

if ($nom === '' || $email === '') {
    echo json_encode([
        "success" => false,
        "message" => "Nom ou email manquant dans la réservation."
    ]);
    exit;
}

/* Vérifier si le client existe déjà */
$clientExiste = false;
$passwordGenere = '';

foreach ($clients as $client) {
    if (isset($client['email']) && $client['email'] === $email) {
        $clientExiste = true;
        $passwordGenere = isset($client['password']) ? $client['password'] : '';
        break;
    }
}

/* Générer un mot de passe si le client n'existe pas encore */
if (!$clientExiste) {
    $passwordGenere = genererMotDePasse(10);

    $nouvelId = 1;
    if (!empty($clients)) {
        $ids = array_column($clients, 'id');
        $nouvelId = max($ids) + 1;
    }

    $clients[] = [
        "id" => $nouvelId,
        "nom" => $nom,
        "email" => $email,
        "password" => $passwordGenere
    ];

    $okClients = file_put_contents(
        $fichierClients,
        json_encode($clients, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );

    if ($okClients === false) {
        echo json_encode([
            "success" => false,
            "message" => "Erreur lors de la création du compte client."
        ]);
        exit;
    }
}

/* Sauvegarder la réservation acceptée */
$okReservations = file_put_contents(
    $fichierReservations,
    json_encode($reservations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

if ($okReservations === false) {
    echo json_encode([
        "success" => false,
        "message" => "Erreur lors de l'enregistrement de la réservation."
    ]);
    exit;
}

/* Préparer infos réservation */
$dateDebut = isset($reservationSelectionnee['date_debut']) ? $reservationSelectionnee['date_debut'] : '';
$dateFin = isset($reservationSelectionnee['date_fin']) ? $reservationSelectionnee['date_fin'] : '';
$nbPersonnes = isset($reservationSelectionnee['nb_personnes']) ? $reservationSelectionnee['nb_personnes'] : '';
$chambre = isset($reservationSelectionnee['chambre']) ? $reservationSelectionnee['chambre'] : '';
$activitesTexte = "Aucune";

if (isset($reservationSelectionnee['activites']) && is_array($reservationSelectionnee['activites']) && count($reservationSelectionnee['activites']) > 0) {
    $nomsActivites = [];

    foreach ($reservationSelectionnee['activites'] as $activite) {
        if (isset($activite['nom'])) {
            $nomsActivites[] = $activite['nom'];
        }
    }

    if (!empty($nomsActivites)) {
        $activitesTexte = implode(", ", $nomsActivites);
    }
}

$urlConnexion = "http://localhost:8000/client/client.php";

$mail = "Bonjour " . $nom . ",\n\n";
$mail .= "Votre réservation à l'Hôtel des Rêves Lucides a été acceptée.\n\n";
$mail .= "Récapitulatif de votre réservation :\n";
$mail .= "- Numéro de réservation : " . $reservationSelectionnee['id'] . "\n";
$mail .= "- Date d'arrivée : " . $dateDebut . "\n";
$mail .= "- Date de départ : " . $dateFin . "\n";
$mail .= "- Nombre de personnes : " . $nbPersonnes . "\n";
$mail .= "- Chambre : " . $chambre . "\n";
$mail .= "- Activités demandées : " . $activitesTexte . "\n\n";
$mail .= "Un compte client a été créé pour vous.\n";
$mail .= "Vous pouvez vous connecter avec les identifiants suivants :\n\n";
$mail .= "- URL : " . $urlConnexion . "\n";
$mail .= "- Identifiant : " . $email . "\n";
$mail .= "- Mot de passe : " . $passwordGenere . "\n\n";
$mail .= "En vous connectant, vous pourrez consulter votre réservation et ajouter des prestations.\n\n";
$mail .= "Cordialement,\n";
$mail .= "L'équipe de l'Hôtel des Rêves Lucides";

echo json_encode([
    "success" => true,
    "message" => "Réservation acceptée et compte client créé.",
    "mailData" => [
        "url" => $urlConnexion,
        "email" => $email,
        "password" => $passwordGenere,
        "content" => $mail
    ]
]);

function genererMotDePasse($longueur = 10)
{
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $motDePasse = '';
    $maxIndex = strlen($caracteres) - 1;

    for ($i = 0; $i < $longueur; $i++) {
        $motDePasse .= $caracteres[random_int(0, $maxIndex)];
    }

    return $motDePasse;
}
