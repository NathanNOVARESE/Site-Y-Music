<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un post</title>
    <link rel="stylesheet" href="../Assets/styles/post.css">
</head>
<body>
    <div class="container">
        <h1>Créer un post</h1>
        <form action="create_post_action.php" method="POST">
            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" required>
            </div>
            <div class="form-group">
                <label for="contenu">Contenu :</label>
                <textarea id="contenu" name="contenu" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image :</label>
                <input type="file" id="image" name="image">
            </div>
            <button type="submit">Créer le post</button>
        </form>
    </div>
</body>
</html>
