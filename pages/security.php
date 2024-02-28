
<?php
// Initialiser la session
session_start();

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
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
        header('Location: ../login.php');
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
    <!-- Ajouter des liens vers des fichiers CSS externe -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="../Assets/styles/security.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="header">
        <!-- Barre de recherche -->
        <input type="text" class="search" placeholder="Search">
        <button class="fas fa-search" id="ellipse"></button>

        <!-- Logo -->
        <img class="logo" src="../Assets/logo.png" />

        <div class="box">
            <div class="setting">
                <div class="right">
                    <!-- Section pour changer le mot de passe -->
                    <div class="text-profile">Password and security</div>
                    <div class="change_password">Change password</div>
                    <div class="div_change_password">
                        <!-- Formulaire de changement de mot de passe -->
                        <form action="security.php" method="post">
                            <!-- Champs pour le nouveau mot de passe -->
                            <div class="div_new_password">
                                <div class="new_password">New password</div>
                                <input type="password" name="new_password" class="input_new_password" placeholder="New password">
                            </div>

                            <!-- Champs pour le mot de passe actuel et la confirmation -->
                            <div class="div_confirm_password">
                                <div class="ancien_password">Current password</div>
                                <input type="password" name="current_password" class="input_current_password" placeholder="Current password">
                                <div class="new_password">New password</div>
                                <input type="password" name="new_password" class="input_new_password" placeholder="New password">
                                <div class="confirm_password">Confirm password</div>
                                <input type="password" name="confirm_password" class="input_confirm_password" placeholder="Confirm password">
                                <button class="submit"><div class="submit-text">Submit</div></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="left">
                    <!-- Section pour le profil utilisateur -->
                    <div class="overlap">
                        <div class="profile-wrapper"><div class="profile" onclick="window.location.href='setting_user.php'">Profile</div></div>
                        <div class="security-wrapper"><div class="security" onclick="window.location.href='security.php'">Sécurité</div></div>

                        <!-- Section pour changer l'image de profil -->
                        <div class="image_change">
                            <img class="profile-picture" src="" />
                            <?php
                                // Afficher l'image de profil de l'utilisateur
                                if ($row && isset($row['profile_picture'])) {
                                    $imageData = $row['profile_picture'];
                                    echo '<img src="data:image/jpeg;base64,' . $imageData . '" class="profile-picture">';
                                } else {
                                    echo '<img src="Assets/profile.png" class="profile-picture">';
                                }
                            ?>
                            <!-- Bouton pour changer l'image de profil -->
                            <input type="file" id="file_input" style="display: none;" onchange="uploadImage()">
                            <script>
                                // Fonction pour télécharger une nouvelle image de profil
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
                        </div>

                        <!-- Informations sur le nom d'utilisateur -->
                        <div class="username-info">
                            <?php
                                // Afficher le nom d'utilisateur de l'utilisateur
                                if ($row && isset($row['username'])) {
                                    $username = $row['username'];
                                    echo $username;
                                } else {
                                    exit;
                                }
                            ?>
                        </div>

                        <!-- Section pour obtenir de l'aide -->
                        <div class="sav-text-wrapper" onclick=""><p class="sav-text">How can we help you ?</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
