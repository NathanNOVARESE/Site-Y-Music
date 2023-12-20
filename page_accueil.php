<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
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
        <div class="logo">
          <img src="Assets/logo.jpg">
        </div>
        <div class="search-box">
          <input class="search-txt" type="text" name="" placeholder="Search...">
          <a class="search-btn" href="#">
            <i class="fas fa-search"></i>
          </a>
        </div>
          <ul class="nav-list">
            <li class="item"><a href="setting_user.php">Setting</a></li>
            <li class="item"><a href="Festival1">Fest1</a></li>
            <li class="item"><a href="Festival2">Fest2</a></li>
            <li class="item"><a href="Festival3">Fest3</a></li>
          </ul>
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
      <section>
        <h1>Actualités</h1>
        <h2>Les Ardentes</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum eos quae quo tempore perferendis fuga, nulla commodi totam pariatur sit molestiae quia error excepturi, corrupti modi, et deserunt maiores architecto.</p>
      </section>
    </main>
</body>
</html>
