<?php
class Billet {
    private $connexion;
    private $trajet;
    private $prix;
    private $statut;
    private $admin;

    // Constructeur
    public function __construct($connexion, $trajet, $prix, $statut, $admin) {
        $this->connexion=$connexion;
        $this->trajet = $trajet;
        $this->prix = $prix;
        $this->statut = $statut;
        $this->admin = $admin;
    }

    // Getters
    public function getTrajet() {
        return $this->trajet;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function getIdAdmin() {
        return $this->admin;
    }
    // Méthode pour ajouter des billets
    public function addBillet($trajet, $prix, $statut, $id_admin)
    {
        try {
            // Requête SQL pour insérer un nouveau billet
            $sql = "INSERT INTO billet (trajet, prix, statut, id_admin) VALUES (:trajet, :prix, :statut, :id_admin)";

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
            header("Location: ReadBillet.php");
            exit();
        } catch (PDOException $e) {
            // En cas d'erreur, affichage de l'erreur et gestion appropriée
            echo "Erreur lors de l'ajout du billet : " . $e->getMessage();
        }
    }

    public function readBillet()
    {
        try {
            // Requête SQL pour sélectionner tous les billets avec les détails de l'administrateur
            $sql = "SELECT b.trajet, b.prix, b.statut, a.email 
                    FROM billet b 
                    INNER JOIN admin a ON b.id_admin = a.id";
            $stmt = $this->connexion->prepare($sql);

            $stmt->execute();
    
            // Récupérer tous les résultats sous forme de tableau associatif
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Retourner les résultats
            return $resultat;
        } catch (PDOException $e) {
            // Gérer les erreurs
            echo "Erreur lors de la récupération des billets : " . $e->getMessage();
            
        }
    }
    





}