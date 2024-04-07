
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="connexion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
   <div class="container">
   <div class="logo">
        <img src="./images/building.webp" alt="logo">
    </div>
    
   <div class="formulaire">
   <h1>Connexion</h1>
    <form action="traitement_connexion.php" method="post">
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <input type="password" id="motdepasse" name="motdepasse" placeholder="Mot de passe" required><br>
        <input type="submit" value="CONNECTER">
        <p>OU</p>
        <div class="button">
          <a href="inscription.php" class="button-inscription">Créer un compte</a>

        </div>
    </form>
   
   </div>
   </div>
    
</body>
</html>