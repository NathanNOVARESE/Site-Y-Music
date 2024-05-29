<?php
session_start();
require 'db_connection.php'; // Fichier pour la connexion à la base de données

if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour accéder à la billetterie.");
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$ticket_code = bin2hex(random_bytes(10)); // Génération d'un code de billet unique

$stmt = $conn->prepare("INSERT INTO tickets (post_id, user_id, ticket_code) VALUES (?, ?, ?)");
if ($stmt->execute([$post_id, $user_id, $ticket_code])) {
    echo "Succès";
} else {
    echo "Erreur";
}