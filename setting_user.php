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
<html>
<head>
    <title>Setting</title>
    <link rel="stylesheet" href="setting_user.css">
</head>
<body>
    <div class="search_bar">
        <i class="fas fa-search"></i>
        <input type="search" name="search" placeholder="Search..">
    </div>
    <div class="compte_overview">
        <div class="compte_overview_img">
            <img src="profile.png" alt="Avatar">
        </div>
        <div class="compte_overview_text">
            <h1>Welcome</h1>
            <div class="usernam">
                <?php
                    echo $_POST['username']
                ?>
            </div>
        </div>
    </div>
    <div class="categorie">
        <div class="Profile">
            <p>Profile</p>
        </div>
        <div class="Setting">
            <P>Setting</p>
        </div>
    </div>
    <div class="sav">
        <p>How can we help you ?</p>
    </div>
</body>
</html>
