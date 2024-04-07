<?php
require_once 'config.php';
require_once 'Billet.php';


    $billet = new Billet($connexion, null, null, null, null, null); 
    $reservations = $billet->getReserveBille();

    // Afficher les réservations de billets
    echo "<h2>Réservations de billets :</h2>";
    echo "<div class='card-container'>";
    foreach ($reservations as $reservation) {
        echo "<div class='card'>";
        echo "<p>ID Réservation: ".$reservation['id']."</p>";
        echo "<p>Trajet: ".$reservation['trajet']."</p>";
        echo "<p>Prix: ".$reservation['prix']."</p>";
        echo "<p>Nom: ".$reservation['nom']."</p>";
        echo "<p>Prénom: ".$reservation['prenom']."</p>";
        echo "<p>Email: ".$reservation['email']."</p>";
        echo "<p>Téléphone: ".$reservation['telephone']."</p>";
        echo "<p>Date: ".$reservation['date']."</p>";
        echo "</div>";
    }
    echo "</div>";
?>

<style>
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        width: 300px;
        background-color: #f9f9f9;
    }

    .card p {
        margin: 5px 0;
    }
</style>
