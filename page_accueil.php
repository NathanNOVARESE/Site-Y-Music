
<?php
  session_start();
  // Vérifiez d'abord s'il y a un message de statut de l'inscription dans l'URL
  if (isset($_GET['signup_message'])) {
      $signupMessage = $_GET['signup_message'];
      // Affichez le message de statut (succès ou échec) ici où vous le souhaitez dans votre page
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
        <div class="logo">
          <img src="Assets/logo.jpg" alt="Logo Site Y'music">
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
    
      <div class="div-actu">
        <h1 class="text-actu">
          Actualités
        </h1>
      </div>

      <div class="rond">

      </div>
      
      <div class="scroll-bg">
        <div class="scroll-div">
          <div class="scroll-object">

            <div class="festi_name">
                <p>
                  Nom Festival
                </p>
            </div>

            <div class="festi_text">
                <p class="festi_text_1">
                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi labore eius alias quidem velit totam ex deleniti expedita. Architecto cum possimus aliquam ut ipsam magni recusandae iure dolore. Modi voluptate eius consectetur? Adipisci fugiat reprehenderit exercitationem, nam delectus autem perspiciatis rem, unde aliquam facilis at, dolor non illum amet fuga cupiditate tempore natus voluptatibus magnam. Libero placeat, asperiores molestias, eligendi provident officiis ducimus optio temporibus itaque ea ipsa, numquam aliquam. Sapiente quibusdam, vitae repudiandae delectus rerum, et deserunt minus iusto consectetur, minima optio eligendi recusandae cumque odit error placeat. Fuga quisquam officia ex blanditiis nam modi cum quae voluptates veritatis.
              </p>
            </div>


            <div class="card">
              <div class="content-card">

                <div class="festi_pic1">
                  <img class="pic1" src="Assets/quokka.jpg">
                </div>
              </div>
            </div>

            <div class="card2">
              <div class="content-card">
                <div class="festi_pic2">
                  <img class="pic2" src="Assets/quokka2.jpg">
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="white-gradiant">

      </div>

    </main>
</body>
</html>
