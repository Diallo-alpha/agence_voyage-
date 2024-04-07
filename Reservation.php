<?php

class Reservation
{
    // Propriétés
    private $connexion;
    private $client_id;
    private $billet_id;
    private $date_reservation;
    private $etat;

    // Constructeur
    public function __construct($connexion, $client_id, $billet_id, $date_reservation, $etat)
    {
        $this->connexion = $connexion;
        $this->client_id = $client_id;
        $this->billet_id = $billet_id;
        $this->date_reservation = $date_reservation;
        $this->etat = $etat;
    }

    // Getters
    public function getClientId()
    {
        return $this->client_id;
    }

    public function getBilletId()
    {
        return $this->billet_id;
    }

    public function getDateReservation()
    {
        return $this->date_reservation;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    // Setters
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    public function setBilletId($billet_id)
    {
        $this->billet_id = $billet_id;
    }

    public function setDateReservation($date_reservation)
    {
        $this->date_reservation = $date_reservation;
    }

    public function setEtat($etat)
    {
        $this->etat = $etat;
    }


    //methode pour creer une nouvelle reservation
    public function addReservation($billet_id, $client_id,  $date_reservation, $etat) {
        try {
            // Préparation de la requête SQL
            $query = "INSERT INTO reservation (id_billet, id_client, date, etat) VALUES (:id_billet, :id_client, :date, :etat)";
            
            // Préparation de la requête 
	 
            $statement = $this->connexion->prepare($query);
            
            // Liaison des paramètres
            $statement->bindParam(':id_billet', $billet_id, PDO::PARAM_INT);
            $statement->bindParam(':id_client', $client_id, PDO::PARAM_INT);
            $statement->bindParam(':date', $date_reservation, PDO::PARAM_STR);
            $statement->bindParam(':etat', $etat, PDO::PARAM_STR);
            
            // Exécution de la requête
            $statement->execute();
            
            header("location: ReadReservation.php");
        } catch (PDOException $e) {
            // Gestion des exceptions PDO
            echo "Erreur PDO : " . $e->getMessage();
        }
    }    

    //methode qui permet d'afficher les reservation 


    // Méthode pour mettre à jour l'état d'une réservation
public function updateEtatReservation($reservation_id, $nouvel_etat) {
    try {
        // Préparation de la requête SQL
        $query = "UPDATE reservation SET etat = :nouvel_etat WHERE id = :id";

        // Préparation de la requête
        $statement = $this->connexion->prepare($query);

        // Liaison des paramètres
        $statement->bindParam(':nouvel_etat', $nouvel_etat, PDO::PARAM_STR);
        $statement->bindParam(':id', $reservation_id, PDO::PARAM_INT);

        // Exécution de la requête
        $statement->execute();

        // Vérification si la mise à jour a réussi
        if ($statement->rowCount() > 0) {
            echo "L'état de la réservation a été mis à jour avec succès.";
        } else {
            echo "Impossible de mettre à jour l'état de la réservation.";
        }
    } catch (PDOException $e) {
        // Gestion des exceptions PDO
        echo "Erreur PDO : " . $e->getMessage();
    } catch (Exception $e) {
        // Gestion des autres exceptions
        echo "Erreur : " . $e->getMessage();
    }
}

    //function pour récupérer les réservations d'un client spécifique
    public function getClientReservations($client_id) {
        try {
            $requete = $this->connexion->prepare("SELECT reservation.*, billet.*
                      FROM reservation 
                      LEFT JOIN billet ON reservation.id_billet = billet.id
                      WHERE reservation.id_client = :client_id");
            
            $requete->bindParam(':client_id', $client_id, PDO::PARAM_INT);
            
            $requete->execute();
            // Récupération des résultats
            $client_reservations = $requete->fetchAll(PDO::FETCH_ASSOC);
            // Retourner les réservations du client
            return $client_reservations;
        } catch (PDOException $e) {
            // Gestion des exceptions PDO
            echo "Erreur PDO : " . $e->getMessage();
            return null;
        }
    }
    
    

    //annuler une reservation
    public function annulerReservation($reservation_id) {
        try {
            $statement = $this->connexion->prepare("UPDATE reservation SET etat = 'annulée' WHERE id = :reservation_id");
    
            $statement->bindParam(':reservation_id', $reservation_id, PDO::PARAM_INT);
            
            $success = $statement->execute();
            
            if ($success) {
                return true; // Opération réussie
            } else {
                return false; // Opération échouée
            }
        } catch (PDOException $e) {
            // Log or return error message
            throw new Exception("Erreur PDO : " . $e->getMessage());
        } catch (Exception $e) {
            // Log or return error message
            throw new Exception("Erreur : " . $e->getMessage());
        }
    }
    public function readReservations() {
        try {
            // Requête SQL pour récupérer toutes les réservations avec les informations sur le client, le billet et l'état de la réservation
            $query = "SELECT reservation.*, client.nom, client.prenom, billet.trajet, billet.prix
                        FROM reservation 
                        LEFT JOIN client ON reservation.id_client = client.id 
                        LEFT JOIN billet ON reservation.id_billet = billet.id";
        
            // Préparation de la requête
            $statement = $this->connexion->query($query);
            
            // Récupération des résultats sous forme de tableau associatif
            $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            // Retourner les réservations
            return $reservations;
        } catch (PDOException $e) {
            // Gestion des exceptions PDO
            echo "Erreur PDO : " . $e->getMessage();
            return null;
        }
    }

  
 //Méthode pour récupérer les réservations d'un client spécifique
 public function getClientReserv($client_id) {
     try {
         $query = "SELECT reservation.*, client.nom AS nom_client, billet.trajet*
                   FROM reservation 
                   LEFT JOIN client ON reservation.id_client = client.id
                   LEFT JOIN billet ON reservation.id_billet = billet.id
                   WHERE reservation.id_client = :client_id";
         $statement = $this->connexion->prepare($query);
         $statement->bindParam(':client_id', $client_id, PDO::PARAM_INT);
         $statement->execute();
        
         $client_reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
        
         return $client_reservations;
     } catch (PDOException $e) {
         // Gestion des exceptions PDO
         echo "Erreur PDO : " . $e->getMessage();
         return null;
     }
 }

 

    // require_once "Reservation.php"; // Assurez-vous d'avoir le fichier contenant la classe Reservation

    //         // Requête SQL pour récupérer les détails des réservations avec les informations du billet et du client
    //         $query = "SELECT reservation.*, billet.trajet, billet.prix, client.nom, client.prenom
    //                   FROM reservation
    //                   INNER JOIN billet ON reservation.id_billet = billet.id
    //                   INNER JOIN client ON reservation.id_client = client.id";

    //         try {
    //             // Préparation de la requête
    //             $statement = $connexion->prepare($query);
                
    //             // Exécution de la requête
    //             $statement->execute();
                
    //             // Récupération des résultats
    //             $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
    
}

?>
