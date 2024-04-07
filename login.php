<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Intégration de Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Lien vers votre fichier CSS personnalisé -->
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="custom-login-form">
                <h2 class="mb-4">Connexion</h2>
                <p>Nous sommes heureux de vous revoir !</p>
                <form action="login_session.php" method="POST"> <!-- Correction ici: action pointe vers login_session.php -->
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Saisir votre Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="mot_de_passe" placeholder="Saisir votre mot de passe" required> <!-- Correction ici: name="mot_de_passe" -->
                    </div>
                    <button type="submit" class="btn btn-primary btn-block custom-btn-primary">CONNECTER</button>
                </form>
                <p class="mt-3">Pas encore inscrit ? <a href="inscription.php" class="custom-btn-secondary">Inscrivez-vous ici</a></p>
            </div>
        </div>
    </div>
</div>

    <!-- Intégration de Bootstrap JavaScript (optionnel) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>