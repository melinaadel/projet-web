<?php
header('Content-Type: application/json');

$chemin = __DIR__ . '/../data/reservations.json';

$data = json_decode(file_get_contents($chemin), true);

$id = $_POST['id'] ?? null;

if (!$id) {
    echo json_encode(["success" => false]);
    exit;
}

$data = array_filter($data, function($r) use ($id) {
    return $r['id'] != $id;
});

$data = array_values($data);

file_put_contents($chemin, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode(["success" => true]);