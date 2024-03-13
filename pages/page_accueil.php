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
            <div class="image_feed">
                <img class="image_feed2" src="../Assets/image_accueil1.jpg" alt="image feed">
            </div>
            <div class="like"></div>
            <div class="comment"></div>
            <div class="share"></div>

            <div class="comment2">
                <h1 class="comment_title">Commentaires</h1>
            </div>



            <div class="vide"></div>
       </div>


    </main>
</body>

</html>
