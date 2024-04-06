<?php

    require_once "Billet.php";
    $servername = "localhost";
    $db = "agence_voyage";
    $username = "root";
    $password = "";

    try{
        $connexion = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
        $billet= new Billet($connexion,"trajet", 1000000, "statut", 1);
        $resultat= $billet->readBillet();
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    catch(PDOException $e){
    die("Erreur connexion à la base de données:" .$e->getMessage());

    }
?>