<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver un billet</title>
    <link rel="stylesheet" href="reserve.css">
    <!-- Inclure la feuille de style Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="./images/Logo.png" alt="logo"></a>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="User.php">ACCUEIL</a>
                    </li>
                    
                    <li class="nav-item">
                    <a class="nav-link" href="ReadReservation.php">LISTE DES BILLETS</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="formulaire">
        <div class="container">
            <h1>Faire une Réservation </h1>
            <?php
            require_once "config.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserver'])) {
                // Traitement du formulaire de réservation ici
            }

            // Vérifier si un billet a été sélectionné
            if (isset($_POST['id'])) {
                // Récupération des détails du billet sélectionné depuis la base de données
                $billet_id = $_POST['id'];
                $query = "SELECT * FROM billet WHERE id = ?";
                $statement = $connexion->prepare($query);
                $statement->execute([$billet_id]);
                $billet = $statement->fetch(PDO::FETCH_ASSOC);

                // Afficher le formulaire de réservation avec les détails du billet sélectionné
                echo "<div class='row'>";
                echo "<div class='col-md-6'>";
                echo "<form method='post' action='AddReservation.php'>";
                echo "<input type='hidden' name='id' value='" . $billet['id'] . "'>";
                echo "<div class='form-group'>";
                echo "<label for='trajet'>Trajet :</label>";
                echo "<input type='text' id='trajet' name='trajet' value='" . $billet['trajet'] . "' readonly>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='prix'>Prix :</label>";
                echo "<input type='text' id='prix' name='prix' value='" . $billet['prix'] . "' readonly>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='date'>Date de réservation :</label>";
                echo "<input type='date' id='date' name='date' placeholder='Date de réservation' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='etat'>État de la réservation :</label>";
                echo "<select id='etat' name='etat' required>
                        <option value='confirmé'>Confirmée</option>
                        <option value='en attente'>En attente</option>
                        <option value='annulé'>Annulée</option>
                    </select>";
                echo "</div>";
                echo "<input class='btn btn-primary' type='submit' name='reserver' value='Valider'>";
                echo "</form>";

                echo "</div>";
                echo "<div class='col-md-6'>";
                echo "<img src='./images/240_F_200801160_RwsMwJayAWtlWjnD41DRREgrgihQMdze.jpg' alt='Image' class='img-fluid'>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "<p>Aucun billet sélectionné.</p>";
            }
            ?>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>
