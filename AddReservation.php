<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserver'])) {
    // Assurez-vous que le client est connecté avant de procéder
    session_start();
    if(isset($_SESSION['id'])) {
        // Obtenez l'ID du client connecté à partir de la session
        $client_id = $_SESSION['id'];

        // Traitement du formulaire de réservation
        $billet_id = $_POST['id'];
        $date_reservation = $_POST['date'];
        $etat = $_POST['etat'];

        // Appel de la méthode pour ajouter une nouvelle réservation
        $Reservation->addReservation($billet_id, $client_id, $date_reservation, $etat);
    } else {
        // Redirigez ou affichez un message d'erreur approprié si le client n'est pas connecté
        echo "Vous devez être connecté pour effectuer une réservation.";
    }
}
?>
