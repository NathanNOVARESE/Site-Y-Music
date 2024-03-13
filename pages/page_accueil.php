
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
                    <a href="page_accueil.php" style="text-decoration: none;">
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
                if ($row_admin) {
                    echo '<div class="create-post">
                            <button id="show_post">Créer un post</button>
                                <div class="post"  id="post" style ="display: none;">
                                    <form action="creation_post.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="titre">Titre :</label>
                                            <input type="text" id="titre" name="titre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="contenu">Contenu :</label>
                                            <textarea id="contenu" name="contenu" rows="5" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image :</label>
                                            <input type="file" id="image" name="image">
                                        </div>
                                        <button type="submit">Créer le post</button>
                                    </form>
                                </div>
                            </div>';
                }
            ?>
            <?php
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
