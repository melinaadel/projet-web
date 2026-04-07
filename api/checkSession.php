<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['client'])) {
    echo json_encode([
        'connected' => true
    ]);
} else {
    echo json_encode([
        'connected' => false
    ]);
}