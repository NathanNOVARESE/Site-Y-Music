<?php
session_start();
require 'db_connection.php'; // Fichier pour la connexion à la base de données

if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour effectuer cette action.");
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$action = $_POST['action'];

if ($action == 'like') {
    // Supprimer le dislike si existe
    $conn->prepare("DELETE FROM dislikes WHERE post_id = ? AND user_id = ?")->execute([$post_id, $user_id]);
    // Ajouter le like
    $stmt = $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE date = CURRENT_TIMESTAMP");
} else if ($action == 'dislike') {
    // Supprimer le like si existe
    $conn->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?")->execute([$post_id, $user_id]);
    // Ajouter le dislike
    $stmt = $conn->prepare("INSERT INTO dislikes (post_id, user_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE date = CURRENT_TIMESTAMP");
} else {
    die("Action non reconnue.");
}

if ($stmt->execute([$post_id, $user_id])) {
    echo "Succès";
} else {
    echo "Erreur";
}
