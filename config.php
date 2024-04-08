<?php

    require_once "Billet.php";
    require_once "Reservation.php";
    require_once('Client.php');
    $servername = "localhost";
    $db = "agence_voyage";
    $username = "root";
    $password = "";

    try{
        $connexion = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
        $billet = new Billet($connexion, null,null,null,null,null,null);

        $resultat= $billet->readBillet();
        // Créer une instance de votre classe de gestion des réservations
        $Reservation = new Reservation($connexion, 1, 1, "2024-04-06", "confirmé");
        $client = new Client($connexion ,"thiam", "Haps", "thiam@example.com", "123456789", "password");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    catch(PDOException $e){
    die("Erreur connexion à la base de données:" .$e->getMessage());

    }
?>