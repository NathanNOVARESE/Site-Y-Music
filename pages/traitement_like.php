<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'Vous devez être connecté pour accéder à cette page.']);
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $post_id = $_POST['post_id'];
        $user_id = $row_user['id'];
        $type = $_POST['type']; // 'like' ou 'dislike'

        // Vérifiez si l'utilisateur a déjà liké ou disliké ce post
        $query = $conn->prepare("SELECT * FROM likes WHERE post_id = :post_id AND user_id = :user_id");
        $query->bindParam(':post_id', $post_id);
        $query->bindParam(':user_id', $user_id);
        $query->execute();
        $existing_like = $query->fetch(PDO::FETCH_ASSOC);

        if ($existing_like) {
            if ($existing_like['type'] == $type) {
                // Supprimez le like ou dislike existant
                $query = $conn->prepare("DELETE FROM likes WHERE id = :id");
                $query->bindParam(':id', $existing_like['id']);
                $query->execute();

                // Mettez à jour le compteur de likes/dislikes dans la table posts
                if ($type == 'like') {
                    $query = $conn->prepare("UPDATE posts SET likes = likes - 1 WHERE id = :post_id");
                } else {
                    $query = $conn->prepare("UPDATE posts SET dislikes = dislikes - 1 WHERE id = :post_id");
                }
                $query->bindParam(':post_id', $post_id);
                $query->execute();
            } else {
                // Changez le type de like/dislike
                $query = $conn->prepare("UPDATE likes SET type = :type WHERE id = :id");
                $query->bindParam(':type', $type);
                $query->bindParam(':id', $existing_like['id']);
                $query->execute();

                // Mettez à jour le compteur de likes/dislikes dans la table posts
                if ($type == 'like') {
                    $query = $conn->prepare("UPDATE posts SET likes = likes + 1, dislikes = dislikes - 1 WHERE id = :post_id");
                } else {
                    $query = $conn->prepare("UPDATE posts SET likes = likes - 1, dislikes = dislikes + 1 WHERE id = :post_id");
                }
                $query->bindParam(':post_id', $post_id);
                $query->execute();
            }
        } else {
            // Ajoutez un nouveau like ou dislike
            $query = $conn->prepare("INSERT INTO likes (post_id, user_id, type) VALUES (:post_id, :user_id, :type)");
            $query->bindParam(':post_id', $post_id);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':type', $type);
            $query->execute();

            // Mettez à jour le compteur de likes/dislikes dans la table posts
            if ($type == 'like') {
                $query = $conn->prepare("UPDATE posts SET likes = likes + 1 WHERE id = :post_id");
            } else {
                $query = $conn->prepare("UPDATE posts SET dislikes = dislikes + 1 WHERE id = :post_id");
            }
            $query->bindParam(':post_id', $post_id);
            $query->execute();
        }

        // Récupérez les nouveaux compteurs de likes et dislikes
        $query = $conn->prepare("SELECT likes, dislikes FROM posts WHERE id = :post_id");
        $query->bindParam(':post_id', $post_id);
        $query->execute();
        $post = $query->fetch(PDO::FETCH_ASSOC);

        echo json_encode(['status' => 'success', 'likes' => $post['likes'], 'dislikes' => $post['dislikes']]);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur : ' . $e->getMessage()]);
}

