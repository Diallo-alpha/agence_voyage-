<?php
require_once "config.php";
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si toutes les données du formulaire sont présentes
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['password'])) {
       
        // Assurez-vous que le chemin du fichier est correct

        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $mot_de_passe = $_POST['password'];


        
        $client->addClient($nom, $prenom, $email, $telephone, $mot_de_passe);

            
            header("Location: login.php"); // Rediriger vers une page de succès
            exit();
        
} }
?>
