<?php
class Billet {
    private $connexion;
    private $id;
    private $trajet;
    private $prix;
    private $date_voyage;
    private $statut;
    private $admin;

    // Constructeur

    public function __construct($connexion, $trajet, $prix,$date_voyage, $statut, $admin, $id) {
       
        $this->connexion = $connexion;
        $this->trajet = $trajet;
        $this->prix = $prix;
        $this->date_voyage=$date_voyage;
        $this->statut = $statut;
        $this->admin = $admin;
        $this->id = $id;
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

    public function getDate(){
        return $this->date_voyage;
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

    public function setDate($date_voyage){
        $this->date_voyage=$date_voyage;
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
    public function addBillet($trajet, $prix,$date_voyage, $statut, $id_admin)
    {
        try {
            $sql = "INSERT INTO billet (trajet, prix,date_voyage, statut, id_admin) VALUES (:trajet, :prix,:date_voyage, :statut, :id_admin)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':trajet', $trajet);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':date_voyage', $date_voyage);
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
            $sql = "SELECT b.trajet, b.prix,b.date_voyage, b.statut, a.email 
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
    
    
    public function updateBillet($id_billet, $trajet, $prix,$date_voyage, $statut)
    {
        try {
            $sql = "UPDATE billet SET trajet = :trajet, prix = :prix,date_voyage = :date_voyage, statut = :statut WHERE id = :id_billet";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':trajet', $trajet);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':date_voyage', $date_voyage);
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
                $date_voyage = $resultat['date_voyage'];
                $statut = $resultat['statut'];
                $admin = $resultat['id_admin'];
                // Construire et retourner un nouvel objet Billet
                return new Billet($connexion, $trajet, $prix,$date_voyage, $statut, $admin, $id);
            } else {
                return null; // Retourner null si aucun billet n'est trouvé
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du billet : " . $e->getMessage();
        }
    }
  //rservation d'un billet 
    public function getReserveBille()
        {
           $sql = $this->connexion->prepare("SELECT reservation.id, billet.trajet, billet.prix, client.nom, client.prenom, client.email, client.telephone,billet.date_voyage
                                              FROM reservation
                                              JOIN billet ON reservation.id_billet = billet.id
                                              JOIN client ON reservation.id_client = client.id"
                                              );       
             $sql->execute();
            // Récupération des résultats
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
     
}
?>
