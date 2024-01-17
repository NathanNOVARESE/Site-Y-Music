<?php
  ob_start();
  // Initialiser la session
  session_start();

  // Connectez-vous à votre base de données et récupérez les informations de l'utilisateur
  $signupMessage = '';
  $servername = "localhost";
  $username = "root";
  $password = "BbREe5uP@oZNc@@Z";
  $dbname = "utilisateur";

  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Récupérez les informations de l'utilisateur à partir de la base de données
      $query = $conn->prepare("SELECT * FROM users WHERE username = :username");
      $query->bindParam(':username', $_SESSION["username"]);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);

      if (!$row) {
          throw new Exception("Utilisateur non trouvé.");
      }

  } catch(PDOException $e) {  
      echo "Connection failed: " . $e->getMessage();
  }catch(Exception $e) {
      // Gérer les erreurs liées à l'absence de données utilisateur
      $signupMessage = $e->getMessage();
  }
  ob_end_flush();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Setting</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="setting_user.css">
</head>
<body>
    <div class="header">
        <input type="text" class="search" placeholder="Search">
        <button class="fas fa-search" id="ellipse"></button>
        <img class="logo" src="Assets/logo.png" />
    <div class="box">
      <div class="setting">
        <div class="right">
          <div class="text-profile">Profile</div>
          <button class="submit"><div class="submit-text">Submit</div></button>
          <form method="POST" action="update_user.php" enctype="multipart/form-data">
              <input id="lastname" class="input-ln" placeholder="<?php echo isset($row['lastname']) ? $row['lastname'] : ''; ?>" name="lastname" autocomplete="family-name">
              
              <input id="username" class="input-u" placeholder="<?php echo isset($row['username']) ? $row['username'] : ''; ?>" name="username" autocomplete="username"> 
              
              <input id="email" class="input-mail" placeholder="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" name="email" autocomplete="email">
              
              <input id="firstname" class="input-fn" placeholder="<?php echo isset($row['firstname']) ? $row['firstname'] : ''; ?>" name="firstname" autocomplete="given-name">
         
              <button class="submit"><div class="submit-text">Submit</div></button>
          </form>
          <div class="username">Username</div>
          <div class="email">Email</div>
          <div class="first-n">First Name</div>
          <div class="last-n">Last Name</div>
        </div>
        <div class="left">
          <div class="overlap">
            <div class="profile-wrapper"><div class="profile" onclick="">Profile</div></div>     
            <div class="security-wrapper"><div class="security" onclick="">Sécurité</div></div>
            <img class="profile-picture" src="" />
            <?php
                if ($row && isset($row['profile'])) {
                    $imageData = $row['profile'];
                    echo '<img src="data:image/jpeg;base64,' . $imageData . '" class="profile-picture">';
                } else {
                    echo '<img src="Assets/profile.png" class="profile-picture">';
                }
              ?>
            <div class="username-info">
                <?php
                  if($row && isset($row['username'])){
                    $username = $row['username'];
                    echo $username;
                  }else{
                    exit;
                  }
                ?>
            </div>
            <div class="sav-text-wrapper"><p class="sav-text">How can we help you ?</p></div>
          </div>
        </div>
      </div>
    </div>
</html>