
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" href="/Assets/styles/stylesign.css" rel="stylesheet">
    <link rel="icon" href="icon.png">
</head>

<body>
    <div class="container">
        <div class="image">
            <img src="logo.png" alt="logo" class="logo">
        </div>
        
        <div class="form">
            <div class="form_input">
                <div id="messageDiv" style="display: none;"></div> 
                <!-- Formulaire d'inscription -->
                <form method="POST" action="traitement.php" enctype="multipart/form-data">
                    <!-- Champ pour télécharger une photo de profil -->
                    <input type="file" name="profile_picture">
                    <br />
                    <!-- Champs pour les informations utilisateur -->
                    <input type="text" name="firstname" placeholder="First Name" required>
                    <br />
                    <input type="text" name="lastname" placeholder="Last Name" required>
                    <br />
                    <input type="text" name="username" placeholder="Username" required>
                    <br />
                    <input type="email" name="email" placeholder="Email" required>
                    <br />
                    <input type="password" name="password" placeholder="Password" required>
                    <br />
                    <input type="password" name="confpassword" placeholder="Confirm Password" required>
                    <br />
                    <!-- Bouton pour soumettre le formulaire -->
                    <div class="button">
                        <button type="submit" name="submit">Sign In</button>
                    </div>
                    <!-- Séparateur et bouton de connexion -->
                    <div class="divider">
                        <div class="divider-line"></div>
                        <p class="p">ou</p>
                        <div class="divider-line"></div>
                    </div>
                    <div class="button_inscription">
                        <button type="button" onclick="window.location.href='login.php'">Log In</button>
                    </div>
                </div>
            </form>
            <!-- Affichage du message en cas de redirection depuis traitement.php -->
            <div id="messageDiv" style="display: none;"></div>
        </div>
    </div>
    
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
