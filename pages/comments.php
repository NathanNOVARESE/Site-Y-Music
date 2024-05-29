<?php
session_start();
require 'db_connection.php'; // Fichier pour la connexion à la base de données

if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour poster un commentaire.");
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$content = $_POST['content'];

$stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
if ($stmt->execute([$post_id, $user_id, $content])) {
    echo "Succès";
} else {
    echo "Erreur";
}
