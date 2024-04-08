<?php
require_once "config.php";

// Récupération de tous les billets disponibles depuis la base de données
$query = "SELECT * FROM billet WHERE statut = 'disponible'";
$statement = $connexion->query($query);
$billets = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les billets disponibles</title>
    <link rel="stylesheet" href="user.css">
    <!-- Inclure la feuille de style Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
button, .bouton{
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
.titre {
    padding: 20px;
    margin-top: 5%;
}

.titre h1{
    color: #FE7A15;
    font-size: 60px;
    font-family: iceberg;
    font-weight: bold; 
    text-align: center;
    margin-bottom: 5%;
}
.retour{
    margin: 10px;
}
.retour a{
    font-size: 24px;
    font-family: Roboto;
    text-align: center;
}

</style>
</head>
<body>
    <div class="container">
        <div class="titre"><h1>Tous les billets disponibles</h1></div>
        <div class="row">
            <?php foreach ($billets as $billet): ?>
                <div class="col-md-6">
                    <div class="card">
                        <img src="./images/240_F_659359825_XInQSIa2BUeSM2LuKntmw883qvAsyltr.jpg" class="card-img-top" alt="Image du billet">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $billet['trajet']; ?></h5>
                            <p class="card-text"><span>Prix</span> : <?php echo $billet['prix']; ?></p>
                            <p class="card-text"><span>Date du Voyage</span> : <?php echo $billet['date_voyage']; ?></p>
                            <p class="card-text"><span>Disponibilité</span> : <?php echo $billet['statut']; ?></p>
                            <form method="post" action="reserver.php">
                                <input type="hidden" name="id" value="<?php echo $billet['id']; ?>">
                                <button type="submit" name="reserver">Réserver</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="retour">
    <a href="javascript:history.go(-1);" class="bouton">Retour</a>
    </div>
</body>
</html>
