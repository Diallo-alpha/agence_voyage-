<?php
// Inclure le fichier config.php et créer un objet de votre classe
require_once "config.php";

// Instancier votre objet Billet
$billet = new Billet($connexion, 1, "trajet", 100000, "statut", 1);

// Appeler la méthode readBillet pour récupérer les billets
$billets = $billet->readBillet();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des billets</title>
    <link rel="stylesheet" href="read.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Inclure la feuille de style Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Inclure le script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

   
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="./images/Logo.png" alt="logo"></a>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">AJOUTER UN BILLET</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="ReadBillet.php">LISTE DES BILLETS</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
    <div class="titre">
    <h1>Liste des billets</h1>
    </div>
    <table >
        <thead >
            <tr>
                <th>Trajet</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Email de l'agent</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($billets as $billet): ?>
            <tr>
                <td><?php echo $billet['trajet']; ?></td>
                <td><?php echo $billet['prix']; ?></td>
                <td><?php echo $billet['statut']; ?></td>
                <td><?php echo $billet['email']; ?></td>
                <td><a href="update.php?matricule=" class="btn" ><i class="fas fa-edit fa-2x" style="color: #3011BC;"></i></a></td>
                <td><a href="DeleteBillet.php?id=" class="btn"><i class="fas fa-trash-alt fa-2x" style="color: red;"></i></a></td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</body>
</html>
