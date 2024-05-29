<?php

require('securityAction.php');

// Vérifiez si l'utilisateur est connecté
if(isset($_SESSION['username'])) {
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

        // Vérifiez si l'utilisateur est également un administrateur
        $query_admin = $conn->prepare("SELECT * FROM administrateurs WHERE utilisateur_id = :utilisateur_id");
        $query_admin->bindParam(':utilisateur_id', $row_user['id']);
        $query_admin->execute();
        $row_admin = $query_admin->fetch(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
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
        <div class=greybar></div>

        <img class="barre" src="../Assets/barre.png" alt="barre">        
    </header>

    <main>


        <div class="presentation">
            <p class="presentation_ecriture"> <strong>Y'Music, qu'est-ce que c'est ?</strong> Y'Music est une plateforme de rencontre permettant aux utilisateurs de participer à des concerts hors du commun tout en faisant de belles rencontres ! </p>
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

       </div>

       <div class="feed">
    <?php
    // Intégration de la récupération des événements musicaux via l'API Eventful
    require_once 'EventfulApi.php'; // Inclure la bibliothèque de l'API Eventful

    // Initialiser l'API Eventful avec votre clé API
    $api = new EventfulApi('LMBlKR13SiBWxFjGgHPG8jm_kNMBAKKV6yWBYBQGdgyJkxME2SSPkg');

    // Définir les paramètres de la recherche pour les événements musicaux
    $params = array(
        'category' => 'music',
        'location' => 'FRANCE', // Spécifiez votre emplacement
        'date' => 'Today', // Vous pouvez spécifier la date
        'image_sizes' => 'large', // Demander des images en taille grande
        'page_size' => 5 // Limiter le nombre de résultats
    );

    // Appeler l'API Eventful pour rechercher les événements
    $response = $api->call('/events/search', $params);

    // Vérifier si la réponse est réussie
    if ($response['success']) {
        $events = $response['body']->events->event;

        // Boucler à travers chaque événement et l'afficher
        foreach ($events as $event) {
            $title = $event->title;
            $description = $event->description;
            $image_url = $event->image->large->url;
            $location = $event->venue_name . ', ' . $event->city_name . ', ' . $event->region_abbr;
            $ticket_url = $event->url;

            // Afficher les détails de l'événement dans un format de post
            echo '<div class="post">';
            echo '<h2>' . $title . '</h2>';
            echo '<p>' . $description . '</p>';
            echo '<img src="' . $image_url . '" alt="' . $title . '">';
            echo '<p>' . $location . '</p>';
            echo '<a href="' . $ticket_url . '">Acheter des billets</a>';
            echo '<div class="comment"></div>'; // Section de commentaires
            echo '</div>';
        }
    } else {
        // Afficher un message d'erreur si l'appel à l'API échoue
        echo 'Error: ' . $response['error'];
    }
    ?>

    <?php
    // Suite du code pour afficher les posts existants
    // Requête SQL pour sélectionner les posts
    $query = $conn->query("SELECT * FROM posts ORDER BY date_creation DESC");
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);

    // Affichage des posts
    foreach ($posts as $post) {
        echo "<div class='post'>";
        echo '<div class="image_feed">
                <img class="image_feed2" src="">
             </div>';
        if ($post && isset($post['image'])) {
            $imageData = $post['image'];
            echo '<img src="data:image/jpeg;base64,' . $imageData . '" class="image_feed">';
        }
        echo "<h2>" . $post['titre'] . "</h2>"; // Afficher le titre du post
        echo "<p>" . $post['contenu'] . "</p>"; // Afficher le contenu du post
        echo '<div class="like"></div>';
        echo '<div class="comment"></div>';
        echo '<div class="share"></div>';
        echo '<div class="billet"></div>';
        echo '<div class="comment2">
                <h1 class="comment_title">Commentaires</h1>
            </div>';
        echo "</div>";
    }
    ?>
</div>



    </main>
</body>

</html>
