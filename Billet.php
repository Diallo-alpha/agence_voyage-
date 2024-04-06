<?php
class Billet {
    private $connexion;
    private $id;
    private $trajet;
    private $prix;
    private $statut;
    private $admin;

    // Constructeur

    public function __construct($connexion, $trajet, $prix, $statut, $admin, $id) {
        $this->id=$id;
        $this->connexion=$connexion;
        $this->trajet = $trajet;
        $this->prix = $prix;
        $this->statut = $statut;
        $this->admin = $admin;
        $this->admin = $id;
    }

    // Getters
    public function getId(){
        return $this->id;
    }
    
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
     // Setter pour le trajet
     public function setTrajet($trajet) {
        $this->trajet = $trajet;
    }

    // Setter pour le prix
    public function setPrix($prix) {
        $this->prix = $prix;
    }

    // Setter pour le statut
    public function setStatut($statut) {
        $this->statut = $statut;
    }

    // Setter pour l'admin
    public function setAdmin($admin) {
        $this->admin = $admin;
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
    
    public function updateBillet($id_billet, $trajet, $prix, $statut)
    {
        try {
            // Requête SQL pour mettre à jour un billet existant
            $sql = "UPDATE billet SET trajet = :trajet, prix = :prix, statut = :statut WHERE id_billet = :id_billet";
    
            // Préparation de la requête
            $stmt = $this->connexion->prepare($sql);
    
            // Liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(':trajet', $trajet);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':statut', $statut);
            $stmt->bindParam(':id_billet', $id_billet);
    
            // Exécution de la requête
            $stmt->execute();
    
            // Redirection vers la page d'accueil après la mise à jour du billet
            header("Location: ReadBillet.php");
            exit();
        } catch (PDOException $e) {
            // En cas d'erreur, affichage de l'erreur et gestion appropriée
            echo "Erreur lors de la mise à jour du billet : " . $e->getMessage();
        }
    }
    
    public function deleteBillet($id)
    {
        try {
            // Préparer la requête SQL pour supprimer le billet avec l'ID donné
            $sql = "DELETE FROM billet WHERE id = :id";
            $stmt = $this->connexion->prepare($sql);
            
            // Liaison du paramètre :id avec la valeur fournie
            $stmt->bindParam(':id', $id);
            
            // Exécution de la requête SQL préparée
            $stmt->execute();
            
            // Affichage d'un message de confirmation
            echo "Le billet avec l'ID $id a été supprimé.";
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Erreur lors de la suppression du billet : " . $e->getMessage();
        }
    }




}