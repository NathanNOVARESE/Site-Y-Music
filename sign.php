<!Doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" href="stylesign.css" rel="stylesheet">
    <link rel="icon" href="icon.png">
</head>

<body>
    <div id="messageDiv" style="display: none;"></div> 
    <form method="POST" action="traitement.php">
        <label for"firstname">Votre Prénom</label>
        <input type="text" name="firstname" placeholder="First Name" required>
            <br />
            <label for="lastname">Votre Nom</label>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <br />
            <label for="username">Pseudo</label>
            <input type="text" name="username" placeholder="Username" required>
            <br />
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required>
            <br />
            <label for="password">Mot de passe</label>
            <input type="password" name="password" placeholder="Password" required>
            <br />
            <label for="confpassword">Confirmer mot de passe</label>
            <input type="password" name="confpassword" placeholder="Confirm Password" required>
            <br />
            <input type="submit" name="submit" value="Envoyer">
    </form>
    <script>
        // Vérifiez s'il y a un message à afficher dans l'URL (peut être une redirection depuis traitement.php)
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');

        // Affichez le message s'il est présent
        if (message) {
            const messageDiv = document.getElementById('messageDiv');
            messageDiv.innerText = message;
            messageDiv.style.display = 'block';
        }
    </script>
    
</body>
</html>
