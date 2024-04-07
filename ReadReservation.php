<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réservations</title>
    <link rel="stylesheet" href="ReadReservation.css">
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
                    <a class="nav-link" aria-current="page" href="User.php">ACCUEIL</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="Reserver.php">RÉSERVEZ UN BILLET</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="ReadReservation.php">LISTE DES RÉSERVATIONS</a>
                    
                    <li class="nav-item">
                    <a class="nav-link" href="ReadReservation.php">LISTE DES BILLETS</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <h2>Liste des Réservations</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php
            // Inclure votre fichier de configuration et votre classe de gestion des réservations
            require_once "config.php";
            $reservations = $Reservation->readReservations();
            
                // Affichage des réservations
                foreach ($reservations as $reservation) {
                    ?>
                    <div class="col"> 
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="">Réservation #<?php echo $reservation['id']; ?></h5>
                                <p class="card-text"> <span>Billet:</span> <?php echo $reservation['trajet']; ?> - Prix : <?php echo $reservation['prix']; ?></p>
                                <p class="card-text"> <span>Client:</span> <?php echo $reservation['nom'] . " " . $reservation['prenom']; ?></p>
                                <p class="card-text"> <span>État de la réservation:</span> <?php echo $reservation['etat']; ?></p>
                            </div>
                            <div>
                                <!-- Lien pour modifier la réservation -->
                                <a href="updateReservation.php?id=<?php echo $reservation['id']; ?>" class="btn"><i class="fas fa-edit fa-2x" style="color: #3011BC;"></i></a>

                                <!-- <a href="supprimer_reservation.php?id=<?php echo $reservation['id']; ?>"class="btn "><i class="fas fa-trash-alt fa-2x" style="color: red; ;"></a> -->
                            </div>
                        </div>
                    </div>
                    <?php
                }
            
            ?>
        </div>
    </div>
</body>
</html>