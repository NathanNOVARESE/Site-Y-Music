<?php
  // Démarrer la session
  session_start();

  // Vérifier s'il y a un message de statut d'inscription dans l'URL
  if (isset($_GET['signup_message'])) {
      $signupMessage = $_GET['signup_message'];
      
      // Afficher le message de statut (succès ou échec)
      echo "<p>$signupMessage</p>";
  }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page_accueil.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="page_accueil.js" defer></script>

    <title>Page d'Accueil</title>
</head>

<body>
    <header>
        <nav class="nav">
            <!-- Logo -->
            <div class="logo">
                <button class="btn_accueil">
                    <a href="page_accueil.php">
                        <img src="Assets/logo.jpg" alt="Logo Site Y'music">
                    </a>
                </button>
            </div>

            <!-- Zone de recherche -->
            <div class="search-box">
                <input class="search-txt" type="text" name="" placeholder="Search...">
                <a class="search-btn" href="#">
                    <i class="fas fa-search"></i>
                </a>
            </div>

            <!-- Liste de navigation -->
            <ul class="nav-list">
                <li class="item"><a href="setting_user.php">Setting</a></li>
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
    </header>

    <main>

        <div class="image_fond">
          <img src="Assets/test1.jpg"  img="image_fond" alt="image de fond de page">
        </div>

        <!-- Section Actualités -->
        <div class="div-actu">
            <h1 class="text-actu">Actualités</h1>
        </div>

        <!-- Div ronde -->
        <div class="rond"></div>

        <!-- Zone de défilement des actualités -->
        <div class="scroll-bg">
            <div class="scroll-div">
                <div class="scroll-object">
                    <!-- Contenu de l'actualité -->

                    <!-- Nom du festival -->
                    <div class="festi_name">
                        <p>Festival Givré les Angles</p>
                    </div>

                    <!-- Texte du festival -->
                    <div class="festi_text">
                        <p class="festi_text_1">
                        <p class="text">
                          Bienvenue au Festival d'Hiver aux Angles, un événement unique célébrant la <strong>magie de l'hiver</strong> et la diversité de la musique et de l'humour. Situé dans les magnifiques Pyrénées-Orientales, ce festival éblouissant se déroule à la salle Angléo, offrant une vue panoramique sur les montagnes enneigées.
                        </p>
                        <p class="text">
                          <strong>À Propos du Festival</strong>
                        </p>
                        <ul class="text_ul">
                          <li class="text_li">Propose des spectacles variés : magie, stand-up, reggae, rock, etc.</li>
                          <li class="text_li">Accueille des artistes nationaux et internationaux tels que Chantal Ladesou, Jamel Comedy Club, Marc-Antoine Le Bret, Kevin Mystère, etc.</li>
                          <li class="text_li">Se déroule à la salle Angléo avec une vue sur les montagnes enneigées.</li>
                          <li class="text_li">Organise un casting pour découvrir les talents locaux de demain.</li>
                          <li class="text_li">Événement convivial et festif célébrant la magie de l'hiver et la musique.</li>
                        </ul>
                        </p>
                    </div>

                    <!-- Carte avec image 1 -->
                    <div class="card">
                        <div class="content-card">
                            <div class="festi_pic1">
                                <img class="pic1" src="Assets/fgla1.jpg">
                            </div>
                        </div>
                    </div>

                    <!-- Carte avec image 2 -->
                    <div class="card2">
                        <div class="content-card">
                            <div class="festi_pic2">
                                <img class="pic2" src="Assets/fgla4.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fond blanc dégradé -->
        <div class="white-gradiant"></div>
    </main>
</body>

</html>
