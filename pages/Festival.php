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
        <nav class="nav">

            <div class="logo">
                <button class="btn_accueil">
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
            <div class="ticket">
                <button class="btn_accueil">
                    <a href="page_accueil.php" style="text-decoration: none;">
                        <p class="ticket2">TICKET</p>
                    </a>
                </button>
            </div>
            <div class="contact">
                <button class="btn_accueil">
                    <a href="page_accueil.php" style="text-decoration: none;">
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
        <div class="Festival">
            <h1>Festival</h1>
        </div>
        <div class="post">
            <h1>Post</h1>
        </div>


        <!-- Divisions for North, South, East, West -->

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

        <!-- Blurred background images -->

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

        <!-- North, South, East, West Divisions with Festival Information -->

        <div class="Nord_fest">
            <div class="card soli">
                <img src="../Assets/Solidays.jpg" alt="Solidays" height="200rem" width="240rem">
                <div class="container">
                    <h4><b>Solidays</b></h4>
                    <p>Festival à Paris du 28 au 30 Juin 2024</p>
                </div>
            </div>

            <div class="card close">
                <img src="../Assets/closermusic.jpg" alt="Closer Music" height="200rem" width="240rem">
                <div class="container">
                    <h4><b>Closer Music</b></h4>
                    <p>Festival à Paris du 19 au 21 Janvier 2024</p>
                </div>
            </div>
        </div>

        <div class="Sud_fest">
            <div class="card elecbeachfest">
                <img src="../Assets/electrobeachfest.jpg" alt="Electro Beach Music Festival" height="200rem" width="240rem">
                <div class="container">
                    <h4><b>Electro Beach Music Festival</b></h4>
                    <p>Lorem ipsum dolor sit amet add adrtf ftg</p>
                </div>
            </div>
        </div>

        <div class="Est_fest">
            <div class="card summer">
                <img src="../Assets/summervibration.jpg" alt="Summer Vibration" height="200rem" width="240rem">
                <div class="container">
                    <h4><b>Summer Vibration</b></h4>
                    <p>Lorem ipsum dolor sit amet add adrtf ftg</p>
                </div>
            </div>
        </div>

        <div class="Ouest_fest">
            <div class="card hellfest">
                <img src="../Assets/hellfest.jpg" alt="HellFest" height="200rem" width="240rem">
                <div class="container">
                    <h4><b>HellFest</b></h4>
                    <p>Lorem ipsum dolor sit amet add adrtf ftg</p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
