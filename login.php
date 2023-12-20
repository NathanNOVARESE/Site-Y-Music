<?php
session_start();
$signupMessage = '';
$servername = "localhost";
$username = "root";
$password = "BbREe5uP@oZNc@@Z";
$dbname = "utilisateur";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configure un attribut PDO
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

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
            $error_message = "Username ou mot de passe incorrect !";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" constent="ie=edge">
    <link type="text/css" href="stylelogin.css" rel="stylesheet">
    <link rel="icon" href="icon.png">
    
</head>
<body>
<div class="container">
    <div class="image">
            <img src="logo.png" alt="logo" class="logo">
    </div>
    <div class="form">
        <form method="POST" action="">
            <div class="form_input">
                <label for="username"></label>
                <input type="text" placeholder="Nom d'utilisateur ..." name="username" id="username" required>
                <br/>
                <label for="password"></label>
                <input type="password" placeholder="Mot de passe ..." name="password" id="password" required>
                <br/>
                <div class="button">
                    <button  type="submit" name="submit">Log In</button>
                </div>
                <div class="divider">
                    <div class="divider-line"></div>
                    <p class="p">ou</p>
                    <div class="divider-line"></div>
                </div>
                <div class="button_inscription">
                    <button type="button" onclick="window.location.href='sign.php'">Sign Up</button>

                </div>
                <div class="motdepasse">
                    <a href="forgot.php">Mot de passe oublié ?</a>
                </div>
            </div>
        </form>
    </div>
</div>    

<?php
if(isset($error_message)) {
    echo $error_message;
} else {
    echo $signupMessage;
}
?>
</body>
</html>
