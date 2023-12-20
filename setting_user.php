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
</head>
<body>
    <h1>Setting</h1>
</body>
</html>
