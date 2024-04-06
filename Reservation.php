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
    public function addReservation($client_id, $billet_id, $date_reservation, $etat) {
        try {
            // Préparation de la requête SQL
            $query = "INSERT INTO reservation (id_billet, id_client, date, etat) VALUES (:id_billet, :id_client, :date, :etat)";
            
            // Préparation de la requête
            $statement = $this->connexion->prepare($query);
            
            // Liaison des paramètres
            $statement->bindParam(':id_billet', $client_id, PDO::PARAM_INT);
            $statement->bindParam(':id_client', $billet_id, PDO::PARAM_INT);
            $statement->bindParam(':date', $date_reservation, PDO::PARAM_STR);
            $statement->bindParam(':etat', $etat, PDO::PARAM_STR);
            
            // Exécution de la requête
            $statement->execute();
            
            // Vérification si la réservation a été ajoutée avec succès
            if ($statement->rowCount() > 0) {
                echo "La réservation a été créée avec succès.";
            } else {
                echo "Impossible de créer la réservation.";
            }
        } catch (PDOException $e) {
            // Gestion des exceptions PDO
            echo "Erreur PDO : " . $e->getMessage();
        }
    }
    

    //methode pour mettre à ajour etat d'un réservation 
    public function updateEtatReservation( $nouvel_etat) {
        try {
            // Préparation de la requête SQL
            $query = "UPDATE reservation SET etat = :nouvel_etat WHERE id = :id";
            
            // Préparation de la requête
            $statement = $this->connexion->prepare($query);
            
            // Liaison des paramètres
            $statement->bindParam(':nouvel_etat', $nouvel_etat, PDO::PARAM_STR);
            
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
    
}

?>
