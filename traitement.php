
//Nom du fichier: traitement.php
//Projet: Ymusic
//Version: 1.0
//Description: Ce fichier permet de se créer un compte
//Auteur: Mayssa Hamdaoui
//Date de création: 22.10.2023

<?php
session_start();
$signupMessage = '';
$servername = "localhost";
$username = "root";
$password = "BbREe5uP@oZNc@@Z";
$dbname = "utilisateur";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['submit'])) {
        // Récupération des données du formulaire
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confpassword = $_POST['confpassword'];
        $profile_picture = $_FILES['profile_picture']['tmp_name'];

        // Convertir l'image en base64 pour stockage dans la base de données
        $imgContent = file_get_contents($profile_picture);
        $imgBase64 = base64_encode($imgContent);

        // Vérification de la correspondance des mots de passe
        if ($password != $confpassword) {
            $signupMessage = "Les mots de passe ne correspondent pas.";
        } elseif (strlen($password) < 8) {
            $signupMessage = "Le mot de passe doit contenir au moins 8 caractères.";
        } else {
            // Vérification de l'unicité de l'email
            $queryEmail = $conn->prepare("SELECT COUNT(*) AS count FROM users WHERE email = :email");
            $queryEmail->execute(array('email' => $email));
            $resultEmail = $queryEmail->fetch(PDO::FETCH_ASSOC);

            if ($resultEmail['count'] > 0) {
                $signupMessage = "L'email est déjà utilisé.";
            } else {
                // Hachage du mot de passe
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Insertion de l'utilisateur dans la base de données avec la photo de profil
                $query = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password, profile_picture) VALUES (:firstname, :lastname, :username, :email, :password, :profile_picture)");
                $query->bindParam(':firstname', $firstname);
                $query->bindParam(':lastname', $lastname);
                $query->bindParam(':username', $username);
                $query->bindParam(':email', $email);
                $query->bindParam(':password', $hashedPassword);
                $query->bindParam(':profile_picture', $imgBase64);
                $query->execute();

                // Redirection vers la page d'accueil avec un message de succès
                $_SESSION['username'] = $username;
                header("Location: /pages/page_accueil.php");
                exit();
            }
        }
    }
} catch (PDOException $e) {
    // En cas d'erreur de connexion à la base de données
    $signupMessage = "Connection failed: " . $e->getMessage();
}

// Redirection vers la page de formulaire avec un message d'erreur en cas de problème
header("Location: sign.php?message=" . urlencode($signupMessage));
exit();
?>
