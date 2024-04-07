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
    require_once "config.php"; 

    // Vérifier si l'ID du billet est défini dans $_POST
    if (isset($_POST['id_billet'])) {
        // Récupérer l'ID du billet à partir de $_POST
        $id_billet = $_POST['id_billet'];
       
        $query = "SELECT * FROM billet WHERE id = :id AND statut = 'disponible'";
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
            echo "<p>Le billet sélectionné n'existe pas ou n'est pas disponible.</p>";
        }
    } else {
        echo "<p>Aucun billet sélectionné.</p>";
    }

    // Récupérer et afficher les réservations associées
    $reservations = $Reservation->readReservations(); // Appeler la méthode readReservations pour récupérer les réservations

    if ($reservations) {
        foreach ($reservations as $row) {
            ?>
            <div class="col">
                <div class="card">
                    <img src="./images/240_F_659359825_XInQSIa2BUeSM2LuKntmw883qvAsyltr.jpg" class="card-img-top" alt="...">
                    <div class="card-body" style="height: 390px;">
                        <h5 class="card-title" style="color: #FE7A15;"><img src="./images/Logo.png" alt=""> N° billet de Réservation : <?php echo ' ' . $row['id_billet'] ?></h5>
                        <div class="client">
                            <div class="nom">
                                <h6 style="color: #FE7A15;">Nom et Prénom</h6>
                                <p class="card-text"><?php echo $row['prenom'] . ' ' . $row['nom']; ?> </p>
                            </div>
                            <div class="coordonnees" style="text-align: center; gap: 20px;">
                                <h6 style="color: #FE7A15;">Email</h6>
                                <p class="card-text"><?php echo $row['email'] ?> </p>
                            </div>
                        </div>
                        <div class="trajet_tel">
                            <div class="trajet">
                                <h6 style="color: #FE7A15;">Trajet</h6>
                                <p class="card-text"><?php echo $row['trajet']; ?></p>
                            </div>
                            <div class="tel">
                                <h6 style="color: #FE7A15;">Téléphone</h6>
                                <p class="card-text"><?php echo $row['telephone']; ?></p>
                            </div>
                        </div>
                        <div class="datetime">
                            <div class="date">
                                <h6 style="color: #FE7A15;">Date de réservation</h6>
                                <p class="card-text"><?php echo $row['date']; ?></p>
                            </div>
                            <div class="etat">
                                <h6 style="color: #FE7A15;">État de la réservation</h6>
                                <p class="card-text"><?php echo isset($row['etat']) ? $row['etat'] : "N/A"; ?></p>
                            </div>
                        </div>
                        <div class="price">
                            <div class="prix">
                                <h6 style="color: #FE7A15;">Prix</h6>
                                <p class="card-text"><?php echo $row['prix']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        echo "<p>Aucune réservation trouvée.</p>";
    }
    ?>
    </body>
    </html>
