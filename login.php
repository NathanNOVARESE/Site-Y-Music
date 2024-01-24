/*

*Nom du fichier: login.php
*Projet: Ymusic
*Version: 1.0
*Description: Ce fichier permet de se connecter à la page d'acceuil
*Auteur: Mayssa Hamdaoui
*Date de création: 22.10.2023

*/

<?php
// Démarre la session PHP
session_start();

// Message de connexion ou d'erreur
$signupMessage = '';

// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "BbREe5uP@oZNc@@Z";
$dbname = "utilisateur";

try {
    // Connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configure un attribut PDO
} catch(PDOException $e) {
    // Affiche une erreur si la connexion échoue
    echo "Connection failed: " . $e->getMessage();
}

// Vérifie si le formulaire a été soumis
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username != '' && $password != '') {
        // Utilisation de requêtes préparées pour éviter les injections SQL
        $req = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $req->execute(array('username' => $username));
        $rep = $req->fetch();

        if($rep && password_verify($password, $rep['password'])) {
            // Utilisateur trouvé, connecté avec succès
            $_SESSION['username'] = $username;
            $signupMessage = "Vous êtes connecté !";
            header('Location: page_accueil.php'); // Redirection vers la page d'accueil si l'utilisateur est connecté
            exit();
        } else {
            // Affiche un message d'erreur si le nom d'utilisateur ou le mot de passe est incorrect
            $error_message = "Username ou mot de passe incorrect !";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Métadonnées de la page -->
    <meta charset="UTF-8">
    <title>Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" constent="ie=edge">
    <!-- Liens vers les feuilles de style -->
    <link type="text/css" href="stylelogin.css" rel="stylesheet">
    <link rel="icon" href="icon.png">
</head>
<body>
    <div class="container">
        <!-- Logo de l'application -->
        <div class="image">
            <img src="logo.png" alt="logo" class="logo">
        </div>
        <!-- Formulaire de connexion -->
        <div class="form">
            <form method="POST" action="">
                <div class="form_input">
                    <!-- Champ pour le nom d'utilisateur -->
                    <label for="username"></label>
                    <input type="text" placeholder="Nom d'utilisateur ..." name="username" id="username" required>
                    <br/>
                    <!-- Champ pour le mot de passe -->
                    <label for="password"></label>
                    <input type="password" placeholder="Mot de passe ..." name="password" id="password" required>
                    <br/>
                    <!-- Bouton de soumission du formulaire -->
                    <div class="button">
                        <button  type="submit" name="submit">Log In</button>
                    </div>
                    <!-- Divider et bouton d'inscription -->
                    <div class="divider">
                        <div class="divider-line"></div>
                        <p class="p">ou</p>
                        <div class="divider-line"></div>
                    </div>
                    <div class="button_inscription">
                        <button type="button" onclick="window.location.href='sign.php'">Sign Up</button>
                    </div>
                    <!-- Lien vers la récupération du mot de passe -->
                    <div class="motdepasse">
                        <a href="forgot.php">Mot de passe oublié ?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    // Affiche le message de connexion ou d'erreur
    if(isset($error_message)) {
        echo $error_message;
    } else {
        echo $signupMessage;
    }
    ?>
</body>
</html>
