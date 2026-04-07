<?php
// ============================================================
// api/adminLogin.php
// Vérifie les identifiants de l'administrateur
// Méthode : POST
// Champs : login, password
// ============================================================

error_reporting(E_ALL);
ini_set('display_errors', 1);

$dataFile = "../data/data.json";
$json     = file_get_contents($dataFile);
$data     = json_decode($json, true);

$login    = trim($_POST['login'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!$login || !$password) {
    echo json_encode(["succes" => false, "message" => "❌ Champs manquants."]);
    exit;
}

if ($login === $data['admin']['login'] && $password === $data['admin']['password']) {
    echo json_encode(["succes" => true, "message" => "✅ Connexion admin réussie."]);
} else {
    echo json_encode(["succes" => false, "message" => "❌ Identifiants admin incorrects."]);
}
?>