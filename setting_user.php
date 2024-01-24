<?php
// Initialiser la session
session_start();

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["username"])) {
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

    if (!$row) {
        header('Location: login.php');
        exit();
    }

    // Traitement de la mise à jour des informations de l'utilisateur après la soumission du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_lastname = $_POST['new_lastname'];
        $new_username = $_POST['new_username'];
        $new_email = $_POST['new_email'];
        $new_firstname = $_POST['new_firstname'];

        // Requête de mise à jour
        $updateQuery = $conn->prepare("UPDATE users SET lastname=:lastname, username=:username, email=:email, firstname=:firstname WHERE id=:user_id");
        $updateQuery->bindParam(':lastname', $new_lastname);
        $updateQuery->bindParam(':username', $new_username);
        $updateQuery->bindParam(':email', $new_email);
        $updateQuery->bindParam(':firstname', $new_firstname);
        $updateQuery->bindParam(':user_id', $row['id']);
        $updateQuery->execute();

        // Mettez à jour les variables de session avec les nouvelles données
        $_SESSION['username'] = $new_username;

        // Rafraîchir les données de l'utilisateur après la mise à jour
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Setting</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="setting_user.css?v=<?php echo time(); ?>">
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
                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                        <input type="text" id="new_lastname" class="input-ln" placeholder="<?php echo isset($row['lastname']) ? $row['lastname'] : ''; ?>" name="new_lastname">
                        <input type="text" id="new_username" class="input-u" placeholder="<?php echo isset($row['username']) ? $row['username'] : ''; ?>" name="new_username">
                        <input type="email" id="new_email" class="input-mail" placeholder="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" name="new_email">
                        <input type="text" id="new_firstname" class="input-fn" placeholder="<?php echo isset($row['firstname']) ? $row['firstname'] : ''; ?>" name="new_firstname">
                        <button type="submit" class="submit"><div class="submit-text">Submit</div></button>
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
                        <div class="image_change">
                          <img class="profile-picture" src="" />
                          <?php
                              if ($row && isset($row['profile_picture'])) {
                                  $imageData = $row['profile_picture'];
                                  echo '<img src="data:image/jpeg;base64,' . $imageData . '" class="profile-picture">';
                              } else {
                                  echo '<img src="Assets/profile.png" class="profile-picture">';
                              }
                          ?>
                          <input type="file" id="file_input" style="display: none;" onchange="uploadImage()">
                          <script>
                            function uploadImage() {
                                var fileInput = document.getElementById('file_input');
                                var file = fileInput.files[0];
                                var formData = new FormData();
                                formData.append('profile_picture', file);

                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', 'newimage.php', true);
                                
                                xhr.onload = function () {
                                    if (this.status == 200) {
                                        location.reload();
                                    } else {
                                        console.error('Upload failed');
                                    }
                                };
                                xhr.send(formData);
                            }
                          </script>
                          <button  id="btn_image" onclick="document.getElementById('file_input').click();">
                            <i class="fas fa-camera text-white"></i>
                        </button>
                          </button>
                        </div>
                        <div class="username-info">
                            <?php
                                if ($row && isset($row['username'])) {
                                    $username = $row['username'];
                                    echo $username;
                                } else {
                                    exit;
                                }
                            ?>
                        </div>
                        <div class="sav-text-wrapper"><p class="sav-text">How can we help you ?</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
