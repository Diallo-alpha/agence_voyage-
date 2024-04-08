<?php
require_once "config.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si toutes les données du formulaire sont présentes
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['password'])) {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $mot_de_passe = $_POST['password'];

        // Expression régulière pour valider le prénom et le nom (par exemple, seulement des lettres et espaces)
        $regex_nom_prenom = "/^[a-zA-Z\s]+$/";

        // Expression régulière pour valider l'email
        $regex_email = "/^\S+@\S+\.\S+$/";

        // Expression régulière pour valider le numéro de téléphone (format international)
        $regex_telephone = "/^\+?\d{6,}$/";

       
        // Vérifier si les données saisies correspondent aux expressions régulières
        if (preg_match($regex_nom_prenom, $nom) && preg_match($regex_nom_prenom, $prenom) && preg_match($regex_email, $email) && preg_match($regex_telephone, $telephone) ) {
            // Les données sont valides, vous pouvez les traiter
            $client->addClient($nom, $prenom, $email, $telephone, $mot_de_passe);

            header("Location: login.php"); // Rediriger vers une page de succès
            exit();
        } else {
            header("Location: inscription.php"); // Rediriger vers une page de succès
            exit();
           
        }
        
    }
}
?>
