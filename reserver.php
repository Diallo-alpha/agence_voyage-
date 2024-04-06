<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acheter un billet</title>
    <link rel="stylesheet" href="reserver.css">
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
                    <a class="nav-link" aria-current="page" href="index.php">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="Reserver.php">RÉSERVEZ UN BILLET</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="read_billet.php">LISTE DES BILLETS</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
     </header>
    <section class="formulaire">
        <h1>RESERVER UN BILLET</h1>
        <?php
        // Vérifier si l'ID du billet est défini dans $_POST
        if (isset($_POST['id'])) {
            // Récupérer l'ID du billet à partir de $_POST
            $id_billet = $_POST['id'];
            // Connexion à la base de données et récupération des informations du billet (à remplacer par votre propre logique)
            require_once "config.php";
            $query = "SELECT * FROM billet WHERE id = :id";
            $statement = $connexion->prepare($query);
            $statement->bindParam(':id', $id_billet);
            $statement->execute();
            $billet = $statement->fetch(PDO::FETCH_ASSOC);

            // Vérifier si les informations du billet ont été récupérées avec succès
            if ($billet) {
                echo "<h2>Détails du billet</h2>";
                echo "<p>Le Trajet : " . $billet['trajet'] . "</p>";
                echo "<p>Prix : " . $billet['prix'] . "</p>";
                // Afficher d'autres informations du billet si nécessaire
            } else {
                echo "<p>Le billet sélectionné n'existe pas.</p>";
            }
        } else {
            echo "<p>Aucun billet sélectionné.</p>";
        }

        // Affichage du formulaire de réservation
        echo "<h2>Informations personnelles</h2>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='id' value='" . $id_billet . "'>"; // Correction ici
        echo "<label for='nom'>Nom :</label><br>";
        echo "<input type='text' id='nom' name='nom'><br>";
        echo "<label for='prenom'>Prenom :</label><br>";
        echo "<input type='text' id='prenom' name='prenom'><br>";
        echo "<label for='email'>Email :</label><br>";
        echo "<input type='text' id='email' name='email'><br>";
        echo "<label for='telephone'>Téléphone:</label><br>";
        echo "<input type='text' id='telephone' name='telephone'><br>";
        // Ajouter d'autres champs pour les informations personnelles (prénom, email, téléphone, etc.)
        echo "<input type='submit' value='Réserver'>";
        echo "</form>";
        ?>
        
        <div class="col-md-6">
            <img src="./images/240_F_200801160_RwsMwJayAWtlWjnD41DRREgrgihQMdze.jpg" alt="Image" class="img-fluid">
        </div>
        </div>
    </section>
</div>

</body>
</html>
