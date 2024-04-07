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
        $this->id = $id;
        $this->connexion = $connexion;
        $this->trajet = $trajet;
        $this->prix = $prix;
        $this->statut = $statut;
        $this->admin = $admin;
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
            $sql = "INSERT INTO billet (trajet, prix, statut, id_admin) VALUES (:trajet, :prix, :statut, :id_admin)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':trajet', $trajet);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':statut', $statut);
            $stmt->bindParam(':id_admin', $id_admin);
            $stmt->execute();
            
            header("Location: ReadBillet.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout du billet : " . $e->getMessage();
        }
    }

    public function readBillet()
    {
        try {
            $sql = "SELECT b.trajet, b.prix, b.statut, a.email 
                    FROM billet b 
                    INNER JOIN admin a ON b.id_admin = a.id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute();
    
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $resultat;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des billets : " . $e->getMessage();
        }
    }
    
    
    public function updateBillet($id_billet, $trajet, $prix, $statut)
    {
        try {
            $sql = "UPDATE billet SET trajet = :trajet, prix = :prix, statut = :statut WHERE id = :id_billet";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':trajet', $trajet);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':statut', $statut);
            $stmt->bindParam(':id_billet', $id_billet);
            $stmt->execute();
    
            header("Location: ReadBillet.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du billet : " . $e->getMessage();
        }
    }
    
    public function deleteBillet($id)
    {
        try {
            $sql = "DELETE FROM billet WHERE id = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo "Le billet avec l'ID $id a été supprimé.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du billet : " . $e->getMessage();
        }
    }
    //function pour recuperer tous les billets 

public function getListeBillests()
{
    try {
        $requete = $this->connexion->query('SELECT b.*, a.email FROM billet b INNER JOIN admin a ON b.id_admin = a.id ORDER BY b.prix ASC');
        $listBillet = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $listBillet;
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des billets : " . $e->getMessage();
    }
}


    //function qui permet d'afficher un seul billet connaissant son id 
    public function getBillet($id)
    {
        try {
            $requete = $this->connexion->prepare("SELECT * FROM billet WHERE id = :id");
            $requete->bindValue(':id', $id);
            $requete->execute();
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);
            
            if ($resultat) {
                // Extraire les données nécessaires pour la construction d'un objet Billet
                $connexion = $this->connexion;
                $trajet = $resultat['trajet'];
                $prix = $resultat['prix'];
                $statut = $resultat['statut'];
                $admin = $resultat['id_admin'];
                // Construire et retourner un nouvel objet Billet
                return new Billet($connexion, $trajet, $prix, $statut, $admin, $id);
            } else {
                return null; // Retourner null si aucun billet n'est trouvé
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du billet : " . $e->getMessage();
        }
    }
    
    
}
?>
