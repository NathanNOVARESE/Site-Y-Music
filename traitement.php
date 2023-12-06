<?php
$signupMessage = '';
$servername = "localhost";
$username = "root";
$password = "BbREe5uP@oZNc@@Z";
$dbname = "utilisateur";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configure un attribut PDO
    if(isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confpassword = $_POST['confpassword'];

        // Vérification de la correspondance des mots de passe
        if ($password != $confpassword) {
            $signupMessage = "Les mots de passe ne correspondent pas.";
        } else {
            // Vérification de la longueur du mot de passe
            if (strlen($password) < 8) {
                $signupMessage = "Le mot de passe doit contenir au moins 8 caractères.";
            } else {
                // Hachage du mot de passe
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Vérification de l'unicité de l'email
                $queryEmail = $conn->prepare("SELECT COUNT(*) AS count FROM users WHERE email = :email");
                $queryEmail->execute(array('email' => $email));
                $resultEmail = $queryEmail->fetch(PDO::FETCH_ASSOC);

                if ($resultEmail['count'] > 0) {
                    $signupMessage = "L'email est déjà utilisé.";
                }

                // Vérification de l'unicité du pseudo
                $queryUsername = $conn->prepare("SELECT COUNT(*) AS count FROM users WHERE username = :username");
                $queryUsername->execute(array('username' => $username));
                $resultUsername = $queryUsername->fetch(PDO::FETCH_ASSOC);

                if ($resultUsername['count'] > 0) {
                    $signupMessage = "Le pseudo est déjà utilisé.";
                }else {
                    // Email et pseudo sont valides, on peut enregistrer l'utilisateur
                    $query = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password) VALUES (:firstname, :lastname, :username, :email, :password)");
                    $query->bindParam(':firstname', $firstname);
                    $query->bindParam(':lastname', $lastname);
                    $query->bindParam(':username', $username);
                    $query->bindParam(':email', $email);
                    $query->bindParam(':password', $hashedPassword);
                    $query->execute();
                    $signupMessage = "Votre compte a bien été créé.";
                }
            }
        }
    }
} catch(PDOException $e) {  
    $signupMessage = "Connection failed: " . $e->getMessage();
}
header("Location: sign.php?message=" . urlencode($signupMessage));
exit();
?>
