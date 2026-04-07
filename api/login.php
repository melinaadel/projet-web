<?php
session_start();
header('Content-Type: application/json');

$cheminFichier = __DIR__ . '/../data/clients.json';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Méthode non autorisée'
    ]);
    exit;
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!file_exists($cheminFichier)) {
    echo json_encode([
        'success' => false,
        'message' => 'Fichier clients introuvable'
    ]);
    exit;
}

$contenu = file_get_contents($cheminFichier);
$clients = json_decode($contenu, true);

if (!is_array($clients)) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur de lecture'
    ]);
    exit;
}

foreach ($clients as $client) {
    if ($client['email'] === $email && $client['password'] === $password) {
        $_SESSION['client'] = [
            'id' => $client['id'],
            'nom' => $client['nom'],
            'email' => $client['email']
        ];

        echo json_encode([
            'success' => true,
            'message' => 'Connexion réussie'
        ]);
        exit;
    }
}

echo json_encode([
    'success' => false,
    'message' => 'Email ou mot de passe incorrect'
]);