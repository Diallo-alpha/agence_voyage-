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
}

?>
