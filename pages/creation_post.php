<?php

session_start();

require('securityAction.php');

// Vérifiez si l'utilisateur est connecté
if(isset($_SESSION['username'])) {
    // Connectez-vous à votre base de données et récupérez les informations de l'utilisateur
    $servername = "localhost";
    $username = "root";
    $password = "BbREe5uP@oZNc@@Z";
    $dbname = "utilisateur";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérez les informations de l'utilisateur à partir de la base de données en utilisant son nom d'utilisateur
        $query_user = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $query_user->bindParam(':username', $_SESSION["username"]);
        $query_user->execute();
        $row_user = $query_user->fetch(PDO::FETCH_ASSOC);

        // Vérifiez si l'utilisateur est également un administrateur
        $query_admin = $conn->prepare("SELECT * FROM administrateurs WHERE utilisateur_id = :utilisateur_id");
        $query_admin->bindParam(':utilisateur_id', $row_user['id']);
        $query_admin->execute();
        $row_admin = $query_admin->fetch(PDO::FETCH_ASSOC);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //Vérification des champs du formulaire
            if(isset($_POST["titre"]) && isset($_POST["contenu"])){
                $titre = $_POST["titre"];
                $contenu = $_POST["contenu"];
                $image = $_POST["image"];
            }
            // Si aucune image n'est téléchargée, utiliser l'image par défaut
            if (empty($image)) {
                $defaultImagePath = '/Assets/festival1_fond.jpg';
                $imgContent = file_get_contents($defaultImagePath);
                $format = pathinfo($defaultImagePath, PATHINFO_EXTENSION);
            } else {
                // Récupération du contenu de l'image téléchargée
                $imgContent = file_get_contents($image);
                $format = pathinfo($profile_picture, PATHINFO_EXTENSION);
            }

            // Encodage de l'image en base64
            $imgBase64 = base64_encode($imgContent);
            }


    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Vous devez être connecté pour accéder à cette page.";
}

