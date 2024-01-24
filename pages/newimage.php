/*

*Nom du fichier: newimage.php
*Projet: Ymusic
*Version: 1.0
*Description: Ce fichier permet de changer la photo de profil
*Auteur: Mayssa Hamdaoui
*Date de création: 19.01.2024

*/
<?php
// Démarrage de la session pour accéder aux données de session
session_start();

// Vérification si un fichier image a été soumis
if (isset($_FILES['profile_picture'])) {
    // Récupération des informations sur le fichier
    $file = $_FILES['profile_picture'];
    // Encodage en base64 des données de l'image
    $imageData = base64_encode(file_get_contents($file['tmp_name']));

    // Paramètres de connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "BbREe5uP@oZNc@@Z";
    $dbname = "utilisateur";

    try {
        // Connexion à la base de données avec PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête SQL pour mettre à jour l'image de profil
        $query = $conn->prepare("UPDATE users SET profile_picture = :profile_picture WHERE username = :username");
        // Liaison des paramètres avec les valeurs correspondantes
        $query->bindParam(':profile_picture', $imageData);
        $query->bindParam(':username', $_SESSION["username"]);
        // Exécution de la requête SQL
        $query->execute();
    } catch (PDOException $e) {
        // Gestion des erreurs de connexion à la base de données
        echo "Connection failed: " . $e->getMessage();
    }
}
?>

