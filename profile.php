<?php
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit(); 
}
// FILEPATH: /C:/Users/PC/Documents/Ynov/Site-Y-Music/profile.php

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nouvellePhoto = $_POST["photo"];
    $nouveauNom = $_POST["nom"];
    $nouveauPrenom = $_POST["prenom"];

    // Mettre à jour les informations de l'utilisateur dans la base de données
    // Code pour mettre à jour la base de données...

    // Rediriger l'utilisateur vers la page de profil mise à jour
    header("Location: profile.php");
    exit();
}

// Code pour récupérer les informations de l'utilisateur depuis la base de données
// Code pour afficher les informations de l'utilisateur dans les champs de formulaire...
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
</head>
<body>
    <h1>Profil</h1>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="photo">Photo de profil:</label>
        <input type="file" name="photo" id="photo" accept="image/*"><br>

        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" value="<?php echo $nouveauNom; ?>"><br>

        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" id="prenom" value="<?php echo $nouveauPrenom; ?>"><br>

        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>
