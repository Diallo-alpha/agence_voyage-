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
                    <a class="nav-link" aria-current="page" href="index.php">Ajouter un Billet</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="ReadBillet.php">Liste des Billets</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link"aria-current="page"href="reservation_billet.php"> Liste des Réservations</a>
                        </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>
        <?php
        require_once './config.php';

        // $billet = new Billet($connexion, null, null, null, null,null, null); 
        $reservations = $billet->getReserveBille();

                // Afficher les réservations de billets
        echo "<div class='container'>"; // Conteneur global
        echo "<h2>Réservations de billets :</h2>";
        echo "<div class='card-container'>";
        // Divisez les cartes en lignes et colonnes
        foreach (array_chunk($reservations, 2) as $row) {
            echo "<div class='row'>";
            foreach ($row as $reservation) {
                echo "<div class='col-md-6'>"; // Utilisez col-md-6 pour afficher deux cartes par ligne sur les écrans moyens et plus grands
                echo "<div class='card'>";
                echo "<p><span>ID Réservation:</span> ".$reservation['id']."</p>";
                echo "<p><span>Trajet:</span> ".$reservation['trajet']."</p>";
                echo "<p><span>Prix:</span> ".$reservation['prix']."</p>";
                echo "<p><span>Nom:</span> ".$reservation['nom']."</p>";
                echo "<p><span>Prénom:</span> ".$reservation['prenom']."</p>";
                echo "<p><span>Email:</span> ".$reservation['email']."</p>";
                echo "<p><span>Téléphone</span> ".$reservation['telephone']."</p>";
                echo "<p><span>Date Voyage</span>: ".$reservation['date_voyage']."</p>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        }
        echo "</div>";
        echo "</div>"; 
        ?>


<style>
     

    .navbar {
    
    background-color: #3011BC; 
    font-family: iceberg;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
    background-color: #ffff;
    width: 90px;
    transition: transform 0.3s ease-in-out; 
    }

    .navbar-brand img:hover {
    transform: scale(1.1); 
    }
    .collapse{
    display: flex;
    justify-content: center;
    align-items: center;
    }
    .navbar-nav{
    gap: 20px;
    }
    .nav-item {
    font-weight: bold;
    font-size: 28px;
    
    }

    .navbar-nav .nav-link:hover {
    color:  #FE7A15; 
    }

    .navbar-nav .nav-link {
    color: #ffff; 
    }
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        width: 400px;
        background-color: #f9f9f9;
    }

    .card p span {
        color: #3011BC;
    font-size: 20px;
    font-weight: bold;
    margin-right:25px ;
    }
    .card p{
        font-size: 18px;
    font-weight: 300;
    font-family: roboto;
    }
</style>

</body>
</html>