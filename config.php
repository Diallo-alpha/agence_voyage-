<?php
    $servername = "localhost";
    $db = "agence_voyage";
    $username = "root";
    $password = "";

    try{
        $connexion = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    catch(PDOException $e){
    die("Erreur connexion à la base de données:" .$e->getMessage());

    }
?>