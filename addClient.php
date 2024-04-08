<?php
require_once "config.php";

$erreurs = [];

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si toutes les données du formulaire sont présentes
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['telephone'], $_POST['password'])) {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $mot_de_passe = $_POST['password'];

        // Validation des champs
        if (empty($nom)) {
            $erreurs['nom'] = "Le nom est obligatoire.";
        }
        if (empty($prenom)) {
            $erreurs['prenom'] = "Le prénom est obligatoire.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs['email'] = "L'adresse email est invalide.";
        }
        if (empty($telephone)) {
            $erreurs['telephone'] = "Le numéro de téléphone est obligatoire.";
        }
        if (empty($mot_de_passe)) {
            $erreurs['password'] = "Le mot de passe est obligatoire.";
        }

        // Si aucune erreur, ajouter le client et rediriger
        if (empty($erreurs)) {
            // Assurez-vous que le chemin du fichier est correct
            $client->addClient($nom, $prenom, $email, $telephone, $mot_de_passe);
            header("Location: login.php"); // Rediriger vers une page de succès
            exit();
        }
    }
}
include "inscription.php";
?>
