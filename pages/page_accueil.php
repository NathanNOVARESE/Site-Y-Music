<?php

session_start();

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    // Connectez-vous à votre base de données et récupérez les informations de l'utilisateur
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
        

        // Vérifiez si l'utilisateur est également un administrateur
        $query_admin = $conn->prepare("SELECT * FROM administrateurs WHERE utilisateur_id = :utilisateur_id");
        $query_admin->bindParam(':utilisateur_id', $row_user['id']);
        $query_admin->execute();
        $row_admin = $query_admin->fetch(PDO::FETCH_ASSOC);

        // Intégration de la récupération des événements musicaux via l'API
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://concerts-artists-events-tracker.p.rapidapi.com/artist?name=Ed%20sheeran&page=1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: concerts-artists-events-tracker.p.rapidapi.com",
                "X-RapidAPI-Key: 2f5ad5797dmsh041d88b4e85b622p185f87jsnfd0f7b717a11"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $events = json_decode($response, true)['data'];

            if (!empty($events)) {
                foreach ($events as $event) {
                    $titre = $event['name'];
                    $contenu = $event['description'];
                    $image = $event['image'];
                    $date_creation = date('Y-m-d H:i:s', strtotime($event['startDate']));
                    $utilisateur_id = $row_user['id'];

                    // Check if the post already exists to avoid duplicates
                    $query = $conn->prepare("SELECT COUNT(*) FROM posts WHERE titre = :titre AND date_creation = :date_creation");
                    $query->bindParam(':titre', $titre);
                    $query->bindParam(':date_creation', $date_creation);
                    $query->execute();
                    $count = $query->fetchColumn();

                    if ($count == 0) {
                        // Insert the event as a new post
                        $query = $conn->prepare("INSERT INTO posts (utilisateur_id, titre, contenu, image, date_creation) VALUES (:utilisateur_id, :titre, :contenu, :image, :date_creation)");
                        $query->bindParam(':utilisateur_id', $utilisateur_id);
                        $query->bindParam(':titre', $titre);
                        $query->bindParam(':contenu', $contenu);
                        $query->bindParam(':image', $image);
                        $query->bindParam(':date_creation', $date_creation);
                        $query->execute();
                    }
                }
            }
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Vous devez être connecté pour accéder à cette page.";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/styles/page_accueil.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="../includes/page_accueil.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../includes/comments_like.js"></script>
    <title>Page d'Accueil</title>
</head>

<body>
    <header>
        <nav class="nav">
            <div class="logo">
                <button class="btn_accueil1">
                    <a href="page_accueil.php">
                        <img class="logopng" src="../Assets/logo.png" alt="Logo Site Y'music">
                    </a>
                </button>
            </div>
            <div class="Accueil">
                <button class="btn_accueil">
                    <a href="page_accueil.php" style="text-decoration: none;">
                        <p class="Accueil2">ACCUEIL</p>
                    </a>
                </button>
            </div>
            <div class="a_propos">
                <button class="btn_accueil">
                    <a href="a_propos.php" style="text-decoration: none;">
                        <p class="a_propos2">A PROPOS</p>
                    </a>
                </button>
            </div>
            <div class="festival">
                <button class="btn_accueil">
                    <a href="Festival.php" style="text-decoration: none;">
                        <p class="ticket2">FESTIVAL</p>
                    </a>
                </button>
            </div>
            <div class="contact">
                <button class="btn_accueil">
                    <a href="contact.php" style="text-decoration: none;">
                        <p class="contact2">CONTACT</p>
                    </a>
                </button>
            </div>

            <div class="search-box">
                <input class="search-txt" type="text" name="" placeholder="Rechercher ici...">
                <a class="search-btn" href="#">
                    <i class="fas fa-search"></i>
                </a>
            </div>
            <ul class="nav-list">
                <li class="item"><a href="setting_user.php">Setting</a></li>
                <li class="item"><a href="Festival.php">Festival</a></li>
                <li class="item"><a href="log_out.php">Log out</a></li>
            </ul>
            <button class="btn" id="btn">
                <svg fill="#8975D1" class="hamburger" viewBox="0 0 100 100" width="45">
                    <rect class="row top" width="80" height="10" x="10" y="30" rx="5"></rect>
                    <rect class="row mid" width="80" height="10" x="10" y="50" rx="5"></rect>
                    <rect class="row bot" width="80" height="10" x="10" y="70" rx="5"></rect>
                </svg>
            </button>
        </nav>
        <div class="greybar"></div>
        <img class="barre" src="../Assets/barre.png" alt="barre">
    </header>

    <main>
        <div class="presentation">
            <p class="presentation_ecriture"><strong>Y'Music, qu'est-ce que c'est ?</strong> Y'Music est une plateforme de rencontre permettant aux utilisateurs de participer à des concerts hors du commun tout en faisant de belles rencontres !</p>
        </div>
        <div class="card">
            <div class="content-card">
                <div class="festi_pic1">
                    <img class="pic1" src="../Assets/image_accueil2.jpg">
                </div>
            </div>
        </div>

        <div class="card2">
            <div class="content-card">
                <div class="festi_pic2">
                    <img class="pic2" src="../Assets/image_accueil3.jpg">
                </div>
            </div>
        </div>

        <div class="feed">
            <?php
            $query = $conn->query("SELECT * FROM posts ORDER BY date_creation DESC");
            $posts = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($posts as $post) {
                echo "<div class='post'>";
                if ($post && isset($post['image'])) {
                    echo '<img src="' . $post['image'] . '" class="image_feed">';
                }
                echo "<div class='post-content'>";
                echo "<h2>" . $post['titre'] . "</h2>";
                echo "<p>" . $post['contenu'] . "</p>";
                echo "</div>";
                echo '<div class="post-actions">';
                echo '<button class="like" data-post-id="' . $post['id'] . '">J\'aime</button>';
                echo '<span class="like-count">' . $post['likes'] . '</span>';
                echo '<button class="dislike" data-post-id="' . $post['id'] . '">Je n\'aime pas</button>';
                echo '<span class="dislike-count">' . $post['dislikes'] . '</span>';
                echo '</div>';

                // Affichage des commentaires
                echo '<div class="comment-section">';
                echo '<h3>Commentaires</h3>';

                $query_comments = $conn->prepare("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = :post_id ORDER BY c.created_at DESC");
                $query_comments->bindParam(':post_id', $post['id']);
                $query_comments->execute();
                $comments = $query_comments->fetchAll(PDO::FETCH_ASSOC);

                foreach ($comments as $comment) {
                    echo '<div class="comment">';
                    echo '<div class="avatar"></div>';
                    echo '<div class="text">';
                    echo '<p><strong>' . htmlspecialchars($comment['username']) . '</strong>: ' . htmlspecialchars($comment['content']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }

                // Formulaire d'ajout de commentaire
                echo '<div class="add-comment">';
                echo '<input type="text" class="comment-input" placeholder="Ajouter un commentaire..." data-post-id="' . $post['id'] . '">';
                echo '<button class="comment-button" data-post-id="' . $post['id'] . '">Poster</button>';
                echo '</div>';
                echo '</div>';

                echo "</div>";
            }
            ?>
        </div>

    </main>
</body>

</html>
