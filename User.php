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

    <style>
        .carte {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            width: 300px;
            background-color: #f9f9f9;
        }
        .carte h2 {
            margin-top: 0;
        }
        .carte p {
            margin-bottom: 5px;
        }
        .bouton-reserver {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .bouton-reserver:hover {
            background-color: #45a049;
        }
    </style>
</head>
<style>
    body{
        background-color: #F5F5F5;
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
                    <a class="nav-link" aria-current="page" href="index.php">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="reserver.php">RÉSERVEZ UN BILLET</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="read_billet.php">LISTE DES BILLETS</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="read_billet.php">CONNEXION</a>
                    </li>
                </ul>
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
                <form action="#" method="get">
                    <input type="text" name="destination" placeholder="Entrez votre destination">
                    <input type="date" name="date" placeholder="Date de départ">
                    <button type="submit">Rechercher</button>
                </form>
            </div>
        </section>
        <section class="billet_dispo">
            <h1>Liste des billets disponibles</h1>
            <?php
            require_once "config.php";
            $client_connecte = false; // Par défaut, le client n'est pas connecté

            // Récupération des billets disponibles depuis la base de données
            $query = "SELECT * FROM billet WHERE statut > 0";
            $statement = $connexion->query($query);
            $billets = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Affichage des billets sous forme de cartes
            foreach ($billets as $billet) {
                echo "<div class='carte'>";
                echo "<h2>" . $billet['trajet'] . "</h2>";
                echo "<p>Prix : " . $billet['prix'] . "</p>";
                echo "<p>Disponibilité : " . $billet['statut'] . "</p>";
                echo "<form method='post' action='reserver.php'>";
                echo "<input type='hidden' name='id' value='" . $billet['id'] . "'>";
                echo "<input class='bouton-reserver' type='submit' name='reserver' value='Réserver'>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </section>
        <section class="destinations">
            <div class="container">
                <h2>Destinations populaires</h2>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <div class="card">
                            <img src="./images/palais-communication-au-crepuscule-ete-madrid_1398-2169.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Madrid</h5>
                                <a href="Reserver.php" class=" bouton ">RESERVEZ</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                        <img src="./images/1000_F_170667573_7EnaDhe9xo1elwC9fAVjy02BPiJrZ9PW.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">DUBAI</h5>
                            <a href="Reserver.php" class=" bouton ">RESERVEZ</a>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                        <img src="./images/1000_F_251121174_5xQyUCqSrkswyLHbM9Ne8DQ8Qb0o1HGw.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">TOKYO</h5>
                            <a href="Reserver.php" class=" bouton ">RESERVEZ</a>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                        <img src="./images/1000_F_264549883_ayKb5wQ3jAE0c4EfXan3tJhCHYCyd8Q4.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">PARIS</h5>
                            <a href="Reserver.php" class=" bouton ">RESERVEZ</a>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                        <img src="./images/beau-pont-manhattan-new-york-etats-unis_181624-48458.avif" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">NEW YORK</h5>
                            <a href="Reserver.php" class=" bouton ">RESERVEZ</a>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                        <img src="./images/1000_F_87517185_TnJGDTGa3PKJKvakVdw6ExM5fggHO4mi.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">MECQUE</h5>
                            <a href="Reserver.php" class=" bouton ">RESERVEZ</a>
                        </div>
                        </div>
                    </div>
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