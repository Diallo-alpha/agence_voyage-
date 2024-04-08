<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserver'])) {
    // Traitement du formulaire de réservation
    $billet_id = $_POST['id'];
    $date_reservation = $_POST['date'];
    $etat = $_POST['etat'];
    
    // Appel de la méthode pour ajouter une nouvelle réservation
    $Reservation->addReservation($billet_id, $client_id, $date_reservation, $etat);
}