

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Intégration de Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Lien vers votre fichier CSS personnalisé -->
    <link rel="stylesheet" href="inscription.css">
</head>
<body>
    <div class="container">
        <div class="titre">
            <h2 class="mt-5">Inscription</h2>
            <p class="message">Partez à L'aventure avec Nous</p>
        </div>
        <form action="addClient.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="prenom" placeholder="Prenom" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="nom" placeholder="Nom" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Telephone" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">S'INSCRIRE</button>
        </form>
        <p class="mt-3">Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
    </div>

    <!-- Intégration de Bootstrap JavaScript (optionnel) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>