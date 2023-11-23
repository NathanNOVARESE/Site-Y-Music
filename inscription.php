<?php
// Connexion à la base de données
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '');
if(isset($_POST['envoi'])){
    if(!empty($_POST['pseudo']) and !empty($_POST['mdp'])){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = sha1($_POST['mdp']);
        $insertUser = $bdd->prepare("INSERT INTO user(pseudo, mdp) VALUES(?, ?)");
        $insertUser->execute(array($pseudo, $mdp));

        $recupUser = $bdd->prepare("SELECT * FROM user WHERE pseudo = ? AND mdp = ?");
        $recupUser->execute(array($pseudo, $mdp));
        if($recupUser->rowCount() > 0){
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['id'] = $recupUser->fetch()['id'];
        }    
        echo $_SESSION['id'];   
    }else{
        echo "Veuillez remplir tous les champs";
    }
}
?>
<!DOCTYPE html>
<html> 
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
    <link icon="image/png" href="images/logo.png">
</head>
<body>
    <form method="post" action="" align= "center">
        <input type="text" name="pseudo" placeholder="Pseudo" required autocomplete="off">  
        <br/>   
        <input type="password" name="mdp" placeholder="Mot de passe" required autocomplete="off">
        <br/>
        <input type="submit" name="envoi">
    </form>
</body>
</html>