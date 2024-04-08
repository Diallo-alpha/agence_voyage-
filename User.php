<?php
require_once('verification_session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="user.css">
     <!-- Inclure la feuille de style Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Inclure le script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
</head>
<style>
    body{
        background-color: #F5F5F5;
    }
    /* CSS pour les cartes de billets */
    .billet_dispo .titre {
    padding: 20px;
    margin-top: 5%;
}

.billet_dispo .titre h1{
    color: #FE7A15;
    font-size: 60px;
    font-family: iceberg;
    font-weight: bold; 
    text-align: center;
    margin-bottom: 5%;
}
.card{
    margin-bottom: 30px;
}

.card-text{
    font-size: 18px;
    font-family: Roboto;
    
}
.card-text span{
    color: #FE7A15;
    font-weight: bold;
}
button{
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 22px;
    width: 100%;
    max-width: 300px;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: 1px solid #3011BC;
}


</style>
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
                    <a class="nav-link" href="ReadReservation.php">LISTE DES RESERVATIONS</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="logout.php">DECONNEXION</a>
                    </li>
                </ul>
                <div class="presentation">
                    <?php
                        // session_start();

                        // Vérifie si la session contient les informations du client (nom et prénom)
                        if(isset($_SESSION['prenom']) && isset($_SESSION['nom'])) {
                            // Récupérer le nom et le prénom du client depuis la session
                            $prenom = $_SESSION['prenom'];
                            $nom = $_SESSION['nom'];
                            echo "<div style='position: absolute; top: 10px; right: 0; padding: 10px;'>";
                            // Afficher le nom et le prénom du client
                            echo "Bonjour $prenom $nom <i class='fas fa-heart' style='color: #FE7A15;'></i>";

                        }
                    ?>
                    <style>
                        .presentation{
                                        
                                        width: 200px;
                                        color: #fff;
                                        font-size: 18px;
                                        font-family: Roboto;
                                    }
                    </style>
                </div>

                </div>
            </div>
        </nav>
    </header>
    <main>
        <!-- Bannière principale -->
        <section class="banner">
            <div class="banner-text">
                <h2>Partez à L'aventure avec Nous</h2>
                <p>Recherchez et réservez vos billets de voyage en toute simplicité.</p>
               
            </div>
        </section>
        <div class="container">
    <section class="billet_dispo">
        <div class="titre"><h1>Liste des billets disponibles</h1></div>
        <div class="row">
            <?php
            require_once "config.php";
            $client_connecte = false; // Par défaut, le client n'est pas connecté

            // Récupération des billets disponibles depuis la base de données
            $query = "SELECT * FROM billet WHERE statut = 'disponible'";
            $statement = $connexion->query($query);
            $billets = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Affichage des billets sous forme de cartes
            foreach ($billets as $billet) {
                echo "<div class='col-md-6'>"; // Utilisation des colonnes Bootstrap pour aligner deux cartes par ligne
                echo "<div class='card'>";
                echo "<img src='./images/240_F_659359825_XInQSIa2BUeSM2LuKntmw883qvAsyltr.jpg' class='card-img-top' alt='Image du billet'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $billet['trajet'] . "</h5>";
                echo "<p class='card-text'><span>Prix</span> : " . $billet['prix'] . "</p>";
                echo "<p class='card-text'><span>Disponibilité</span> : " . $billet['statut'] . "</p>";
                echo "<form method='post' action='reserver.php'>";
                echo "<input type='hidden' name='id' value='" . $billet['id'] . "'>";
                echo "<button  type='submit' name='reserver'>Réserver</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </section>
</div>
<section class="destinations">
    <h2>Les destinations les plus populaires</h2>
    <?php
    require_once "config.php";

    $query = "SELECT * FROM destinations_populaires";
    $statement = $connexion->query($query);
    $destinations = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <div class="row">
            <?php foreach ($destinations as $destination) : ?>
                <div class="col-md-6"> <!-- Modifier ici la classe pour aligner deux cartes par ligne -->
                    <div class="card">
                        <img src="<?php echo $destination['image']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $destination['nom']; ?></h5>
                            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
    

    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>A propos de nous</h3>
                    <img src="./images/Logo.png" alt="logo">
                    <p> Recherchez et réservez vos billets de voyage en toute simplicité.</p>
                </div>
                <div class="col-md-4">
                    <h3>Liens rapides</h3>
                    <ul>
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Réservez un billet</a></li>
                        <li><a href="#">Liste des billets</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Contactez-nous</h3>
                    <p>Adresse : 224 Rue, Dakar, SÉNÉGAL</p>
                    <p>Email : simplon@gmail.com</p>
                    <p>Téléphone : 775764323</p>
                </div>
            </div>
            <div class="copyright">
            <p>&copy; 2024 Réservez vos billets</p>
            </div>
        </div>
</footer>

   
</body>
</html>