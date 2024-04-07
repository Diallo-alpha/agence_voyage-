<?php
require_once "config.php"; 
require_once "Reservation.php"; 

// Assuming $billet_id has a valid value, replace it with the actual value you want to use
$billet_id = 1; // Example value

// Instanciate the Reservation class with the database connection and necessary values
$Reservation = new Reservation($connexion, $client_id, $billet_id, $date_reservation, $etat);

// Call the method to retrieve all reservations
$reservations = $Reservation->afficherToutesReservations();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réservations</title>
    <link rel="stylesheet" href="read.css">
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
                            <a class="nav-link" aria-current="page" href="User.php">ACCUEIL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Reserver.php">RÉSERVEZ UN BILLET</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ReadReservation.php">LISTE DES RÉSERVATIONS</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <h2>Liste des Réservations</h2>
        <?php
        // Vérifier si des réservations ont été trouvées
        if ($reservations) {
            foreach ($reservations as $reservation) {
                // Afficher les détails de chaque réservation
                ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ID Réservation: <?php echo $reservation['id_reservation']; ?></h5>
                        <p class="card-text">Client: <?php echo $reservation['nom_client'] . ' ' . $reservation['prenom_client']; ?></p>
                        <p class="card-text">Billet: <?php echo $reservation['nom_billet']; ?></p>
                        <p class="card-text">Date de réservation: <?php echo $reservation['date_reservation']; ?></p>
                        <p class="card-text">État: <?php echo $reservation['etat']; ?></p>
                        <!-- Ajoutez d'autres informations de réservation si nécessaire -->
                    </div>
                </div>
                <br>
                <?php
            }
        } else {
            echo "<p>Aucune réservation trouvée.</p>";
        }
        ?>
        
    </div>
</body>
</html>
