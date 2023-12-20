<?php
// FILEPATH: /c:/Users/PC/Documents/Ynov/Site-Y-Music/setting_user.php

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des champs du formulaire
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Effectuer les opérations de mise à jour des paramètres utilisateur
    // ...

    // Rediriger l'utilisateur vers une autre page après la mise à jour
    header("Location: profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Setting</title>
    <link rel="stylesheet" href="css/setting_user.css">
</head>
<body>
    <div class ="search_bar">
        <input type ="search" name="search" placeholder="Search..">
    </div>
    <div class="compte_overview">
        <div class="compte_overview_img">
            <img src="img/Avatar.png" alt="Avatar">
        </div>
        <div class="compte_overview_text">
            <h1>Welcome</h1>
            <h2 id="username"></h2>
            <img src="img/quit.png" alt="setting">
        </div>
    </div>
    <div class="categorie">
        <div class="Profile">
            <p>Profile</p>
        </div>
        <div class="Setting">
            <P>Setting</p>
        </div>
    </div>
    <div class="sav">
        <p>How can we help you ?</p>
    </div>
</body>
</html>
