<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/styles/Festival.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="../includes/Festival.js" defer></script>
    <title>Festival</title>
</head>

<body>
    <header>
        <!-- Barre de navigation -->
        <nav class="nav">
            <!-- Logo -->
            <div class="logo">
                <button class="btn_accueil1">
                    <a href="page_accueil.php">
                        <img class="logopng" src="../Assets/logo.png" alt="Logo Site Y'music">
                    </a>
                </button>
            </div>
            <!-- Lien vers la page d'accueil -->
            <div class="Accueil">
                <button class="btn_accueil">
                    <a href="page_accueil.php" style="text-decoration: none;">
                        <p class="Accueil2">ACCUEIL</p>
                    </a>
                </button>
            </div>
            <!-- Lien vers la page À propos -->
            <div class="a_propos">
                <button class="btn_accueil">
                    <a href="a_propos.php" style="text-decoration: none;">
                        <p class="a_propos2">A PROPOS</p>
                    </a>
                </button>
            </div>
            <!-- Lien vers la page Festival -->
            <div class="festival">
                <button class="btn_accueil">
                    <a href="Festival.php" style="text-decoration: none;">
                        <p class="ticket2">FESTIVAL</p>
                    </a>
                </button>
            </div>
            <!-- Lien vers la page de contact -->
            <div class="contact">
                <button class="btn_accueil">
                    <a href="contact.php" style="text-decoration: none;">
                        <p class="contact2">CONTACT</p>
                    </a>
                </button>
            </div>

            <!-- Barre de recherche -->
            <div class="search-box">
                <input class="search-txt" type="text" name="" placeholder="Rechercher ici...">
                <a class="search-btn" href="#">
                    <i class="fas fa-search"></i>
                </a>
            </div>
            <!-- Liens de navigation supplémentaires -->
            <ul class="nav-list">
                <li class="item"><a href="setting_user.php">Paramètres</a></li>
                <li class="item"><a href="Festival.php">Festival</a></li>
            </ul>
            <!-- Bouton de menu hamburger -->
            <button class="btn" id="btn">
                <svg fill="#8975D1" class="hamburger" viewBox="0 0 100 100" width="45">
                    <rect class="row top" width="80" height="10" x="10" y="30" rx="5"></rect>
                    <rect class="row mid" width="80" height="10" x="10" y="50" rx="5"></rect>
                    <rect class="row bot" width="80" height="10" x="10" y="70" rx="5"></rect>
                </svg>
            </button>
        </nav>

        <!-- Barre grise -->
        <div class=greybar></div>

        <!-- Barre d'image -->
        <img class="barre" src="../Assets/barre.png" alt="barre">
    </header>

    <main>
        <!-- En-tête Festival -->
        <div class="Festival">
            <h1>Festival</h1>
        </div>
        <!-- Section Post -->
        <div class="post">
            <h1>Post</h1>
        </div>

        <!-- Divisions pour le Nord, le Sud, l'Est, l'Ouest -->
        <div class="Nord">
            <h2>Nord</h2>
        </div>
        <div class="Sud">
            <h2>Sud</h2>
        </div>
        <div class="Est">
            <h2>Est</h2>
        </div>
        <div class="Ouest">
            <h2>Ouest</h2>
        </div>
        <div class="scroll">
            <h2></h2>
        </div>

        <!-- Images de fond floues -->
        <div class="image_fond1">
            <img src="../Assets/festival1_fond.jpg" alt="image fond1" width="100%" height="100%">
        </div>
        <div class="image_fond2">
            <img src="../Assets/image_fond2.jpg" alt="image fond2" width="100%" height="100%">
        </div>
        <div class="image_fond3">
            <img src="../Assets/image_fond3bis.jpg" alt="image fond2" width="100%" height="100%">
        </div>
        <div class="image_fond4">
            <img src="../Assets/image_fond4.jpg" alt="image fond2" width="100%" height="100%">
        </div>

        <!-- Divisions Nord, Sud, Est, Ouest avec les informations sur le festival -->
        <div class="Nord_fest">
            <a href="page_pres_festival.php" class="card soli">
                <img src="../Assets/Solidays.jpg" alt="Solidays" height="200rem" width="240rem">
                <div class="container">
                    <h4><b>Solidays</b></h4>
                    <p>Festival à Paris du 28 au 30 Juin 2024</p>
                </div>
            </a>

            <a href="page_pres_festival.php" class="card close">
                <img src="../Assets/closermusic.jpg" alt="Closer Music" height="200rem" width="240rem">
                <div class="container">
                    <h4><b>Closer Music</b></h4>
                    <p>Festival à Paris du 19 au 21 Janvier 2024</p>
                </div>
            </a>
        </div>

        <div class="Sud_fest">
            <a href="page_pres_festival.php" class="card elecbeachfest">
                <img src="../Assets/electrobeachfest.jpg" alt="Electro Beach Music Festival" height="200rem" width="240rem">
                <div class="container">
                    <h4><b>Electro Beach Music Festival</b></h4>
                    <p>Lorem ipsum dolor sit amet add adrtf ftg</p>
                </div>
            </a>
        </div>

        <div class="Est_fest">
            <a href="page_pres_festival.php" class="card summer">
                <img src="../Assets/summervibration.jpg" alt="Summer Vibration" height="200rem" width="240rem">
                <div class="container">
                    <h4><b>Summer Vibration</b></h4>
                    <p>Lorem ipsum dolor sit amet add adrtf ftg</p>
                </div>
            </a>
        </div>

        <div class="Ouest_fest">
            <a href="page_pres_festival.php" class="card hellfest">
                <img src="../Assets/hellfest.jpg" alt="HellFest" height="200rem" width="240rem">
                <div class="container">
                    <h4><b>HellFest</b></h4>
                    <p>Lorem ipsum dolor sit amet add adrtf ftg</p>
                </div>
            </a>
        </div>
    </main>
</body>

</html>
