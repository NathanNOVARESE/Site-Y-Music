<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'Vous devez être connecté pour ajouter un commentaire.']);
    exit();
}

$servername = "localhost";
$username = "root";
$password = "BbREe5uP@oZNc@@Z";
$dbname = "utilisateur";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query_user = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $query_user->bindParam(':username', $_SESSION["username"]);
    $query_user->execute();
    $row_user = $query_user->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $post_id = $_POST['post_id'];
        $user_id = $row_user['id'];
        $content = $_POST['content'];

        $query = $conn->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)");
        $query->bindParam(':post_id', $post_id);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':content', $content);
        $query->execute();

        echo json_encode(['status' => 'success']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur : ' . $e->getMessage()]);
}
?>
