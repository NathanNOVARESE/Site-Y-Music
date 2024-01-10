<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
    <!-- Vos autres balises meta et liens de style -->
</head>
<body>
    <?php
    // Récupérer les informations de l'utilisateur depuis la base de données
    $servername = "localhost";
    $username = "root";
    $password = "BbREe5uP@oZNc@@Z";
    $dbname = "utilisateur";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Supposons que vous avez une table "users" avec une colonne "profile_picture" contenant l'image en base64

        $query = $conn->query("SELECT profile_picture FROM users WHERE id = '22'"); // Remplacez '1' par l'identifiant de l'utilisateur
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['profile_picture'])) {
            // Afficher l'image stockée en base64
            $imageData = $result['profile_picture'];
            echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="Profile Picture">';
        } else {
            echo 'Image introuvable.';
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</body>
</html>
