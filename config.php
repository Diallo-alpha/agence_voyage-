<?php

    require_once "Billet.php";
    require_once "Reservation.php";
    $servername = "localhost";
    $db = "agence_voyage";
    $username = "root";
    $password = "";

    try{
        $connexion = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
        $billet= new Billet($connexion, 1,"trajet", 1000000, "statut", 1);
        $resultat= $billet->readBillet();
        // Créer une instance de votre classe de gestion des réservations
        $Reservation = new Reservation($connexion, 1, 1, "2024-04-06", "confirmé");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    catch(PDOException $e){
    die("Erreur connexion à la base de données:" .$e->getMessage());

    }
?>