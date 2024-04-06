<?php
class Admin
{
    private $connexion;
    private $email;
    private $motDePasse;

    public function __construct($connexion,$email, $motDePasse) {
        $this->connexion = $connexion; 
        $this->setEmail($email); // Utilisation de la méthode setEmail() pour valider et définir l'email
        $this->setMotDePasse($motDePasse); // Utilisation de la méthode setMotDePasse() pour valider et définir le mot de passe
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return true;
        } else {
            return false; // Email invalide
        }
    }

    public function getEmail() {
        return $this->email;
    }

    public function setMotDePasse($motDePasse) {
        // Vérifie si le mot de passe contient au moins 8 caractères
        // et peut contenir des lettres, des chiffres et des caractères spéciaux
        if (strlen($motDePasse) >= 8 && preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $motDePasse)) {
            $this->motDePasse = $motDePasse;
            return true;
        } else {
            return false; // Mot de passe invalide
        }
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

// Méthode pour ajouter des billets
public function addBillet($trajet, $prix, $statut, $id_admin)
{
    try {
        // Requête SQL pour insérer un nouveau billet
        $sql = "INSERT INTO billet (`trajet`, `prix`, `statut`, `id_admin`) VALUES (:trajet, :prix, :statut, :id_admin)";

        // Préparation de la requête
        $stmt = $this->connexion->prepare($sql);

        // Liaison des valeurs aux paramètres de la requête
        $stmt->bindParam(':trajet', $trajet);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':id_admin', $id_admin);

        // Exécution de la requête
        $stmt->execute();
        
        // Redirection vers la page d'accueil après l'ajout du billet
        header("Location: AddBillet.php");
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur, affichage de l'erreur et gestion appropriée
        echo "Erreur lors de l'ajout du billet : " . $e->getMessage();
    }
}


}