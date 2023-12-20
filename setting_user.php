<?php
// Initialiser la session
session_start();

// Si l'utilisateur est déjà connecté, détruisez la session et redirigez-le vers la page de connexion
if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
}

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
} catch(PDOException $e) {  
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Setting</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="setting_user.css">
</head>
<body>
    <div class="search_bar">
        <input type="search" name="search" placeholder="Search..">
        <button class="icon"><i class="fa fa-search"></i></button>
    </div>
    <div class="compte_overview">
        <div class="compte_overview_img">
            <img src="data:image/<?php echo $row['format']; ?>;base64,<?php echo base64_encode($row['profile_picture']); ?>" alt="Avatar">
        </div>
        <div class="compte_overview_text">
            <h1>Welcome</h1>
            <div class="usernam">
                <?php
                    echo $_SESSION["username"]
                ?>
            </div>
        </div>
    </div>
    <div class="categorie">
        <a href="profile.php" class="Profile">
            <i class="fas fa-user">profile</i>
        </a>
        <a href="setting.php" class="Setting">
            <i class="fas fa-cog">setting</i>
        </a>
    </div>
    <div class="sav">
        <p>How can we help you ?</p>
    </div>
</body>
</html>
