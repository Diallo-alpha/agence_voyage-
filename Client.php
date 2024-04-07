<?php
class Client {
    private $connexion;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $mot_de_passe;

    // Constructeur
    public function __construct($connexion,$nom, $prenom, $email, $telephone, $mot_de_passe) {
        $this->connexion=$connexion;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->mot_de_passe = $mot_de_passe;
    }

    // Méthodes getters
    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getMotDePasse() {
        return $this->mot_de_passe;
    }

    // Méthodes setters
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function setMotDePasse($mot_de_passe) {
        $this->mot_de_passe = $mot_de_passe;
    }


     // Méthode pour ajouter un client dans la base de données
    public function addClient($nom, $prenom, $email, $telephone, $mot_de_passe) {
        try {
            // Préparation de la requête SQL
            $sql = "INSERT INTO client (nom, prenom, email, telephone, mot_de_passe) VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe)";
            $stmt = $this->connexion->prepare($sql);
            
            // Liaison des valeurs avec les paramètres de la requête
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe);

            // Exécution de la requête
            $stmt->execute();

            // Retourner un indicateur de réussite
            return true;

        } catch(PDOException $e) {
            // Gérer les erreurs de requête SQL
            echo "Erreur : " . $e->getMessage();
            return false; // Ou une autre gestion d'erreur selon vos besoins
        }
    }

}
