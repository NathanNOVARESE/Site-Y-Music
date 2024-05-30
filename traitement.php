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
        $description = $_POST['description'];
        $artist1 = $_POST['artist1'];
        $artist2 = $_POST['artist2'];
        $artist3 = $_POST['artist3'];
        $song1 = $_POST['song1'];
        $song2 = $_POST['song2'];
        $song3 = $_POST['song3'];
        $profile_picture = $_FILES['profile_picture']['tmp_name'];

        // Si aucune image n'est téléchargée, utiliser l'image par défaut
        if (empty($profile_picture)) {
            $defaultImagePath = '../Assets/profile.png';
            $imgContent = file_get_contents($defaultImagePath);
            $format = pathinfo($defaultImagePath, PATHINFO_EXTENSION);
        } else {
            // Récupération du contenu de l'image téléchargée
            $imgContent = file_get_contents($profile_picture);
            $format = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
        }

        // Encodage de l'image en base64
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
                // Vérification de l'unicité du nom d'utilisateur
                $queryUsername = $conn->prepare("SELECT COUNT(*) AS count FROM users WHERE username = :username");
                $queryUsername->execute(array('username' => $username));
                $resultUsername = $queryUsername->fetch(PDO::FETCH_ASSOC);

                if ($resultUsername['count'] > 0) {
                    $signupMessage = "Le nom d'utilisateur est déjà utilisé.";
                } else {
                    // Hachage du mot de passe
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Insertion de l'utilisateur dans la base de données avec la photo de profil
                    $query = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password, profile_picture, description, artist1, artist2, artist3, song1, song2, song3) 
                                             VALUES (:firstname, :lastname, :username, :email, :password, :profile_picture, :description, :artist1, :artist2, :artist3, :song1, :song2, :song3)");
                    $query->bindParam(':firstname', $firstname);
                    $query->bindParam(':lastname', $lastname);
                    $query->bindParam(':username', $username);
                    $query->bindParam(':email', $email);
                    $query->bindParam(':password', $hashedPassword);
                    $query->bindParam(':profile_picture', $imgBase64);
                    $query->bindParam(':description', $description);
                    $query->bindParam(':artist1', $artist1);
                    $query->bindParam(':artist2', $artist2);
                    $query->bindParam(':artist3', $artist3);
                    $query->bindParam(':song1', $song1);
                    $query->bindParam(':song2', $song2);
                    $query->bindParam(':song3', $song3);
                    $query->execute();

                    // Redirection vers la page d'accueil avec un message de succès
                    $_SESSION['username'] = $username;
                    header("Location: /pages/page_accueil.php");
                    exit();
                }
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

