<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/styles/a_propos.css">
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
        <div class="pres">
            <h1 class="titre">
                Présentation
            </h1>
            <h2 class="st1"><strong>À propos de Y'Music</strong></h2>
            <p class="txt1">Bienvenue sur Y'Music, votre destination en ligne pour découvrir les festivals et rencontrer et disucter avec des passionnés de musique dans toutes la France. Fondé par CHOUIAH Naïs, DENIS Jade, EL HASSAIN Madiane, FACELLO Lola, HAMDAOUI Mayssa, MARECHAL Clément et NOVARESE Nathan.</p>
            <div class="trt1"></div>

            <h2 class="st1">Notre Mission</h2>
            <p class="txt1">Chez Y'Music, notre mission est de connecter les amateurs de musique avec les festivals qui leur correspondent, tout en facilitant les rencontres et les échanges entre passionnés. Que vous soyez à la recherche d'un festival de jazz intime, d'une expérience électro palpitante ou d'une immersion dans la diversité des musiques du monde, notre plateforme est votre guide ultime.</p>
            <div class="trt1"></div>

        </div>

        <div class="orga_div">
            <img class="orga" src="../Assets/organigramme.png" alt="organigramme">
        </div>

 
    
    </main>

</body>
</html>
