<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'Vous devez être connecté pour commenter.']);
    exit();
}

$servername = "localhost";
$username = "root";
$password = "BbREe5uP@oZNc@@Z";
$dbname = "utilisateur";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérez les informations de l'utilisateur à partir de la base de données en utilisant son nom d'utilisateur
    $query_user = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $query_user->bindParam(':username', $_SESSION["username"]);
    $query_user->execute();
    $row_user = $query_user->fetch(PDO::FETCH_ASSOC);
    $user_id = $row_user['id'];
    $profile_picture = $row_user['profile_picture']; // Ajoutez cette ligne pour récupérer la photo de profil

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $post_id = $_POST['post_id'];
        $content = $_POST['content'];

        // Insérez le commentaire dans la base de données
        $query = $conn->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)");
        $query->bindParam(':post_id', $post_id);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':content', $content);
        $query->execute();

        // Récupérez le commentaire récemment ajouté
        $comment_id = $conn->lastInsertId();
        $query = $conn->prepare("SELECT comments.content, users.username, comments.date FROM comments JOIN users ON comments.user_id = users.id WHERE comments.id = :comment_id");
        $query->bindParam(':comment_id', $comment_id);
        $query->execute();
        $comment = $query->fetch(PDO::FETCH_ASSOC);

        // Ajoutez la photo de profil au commentaire
        $comment['profile_picture'] = $profile_picture;

        echo json_encode(['status' => 'success', 'comment' => $comment]);
        
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur : ' . $e->getMessage()]);
}
