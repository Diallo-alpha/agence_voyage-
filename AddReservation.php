<?php
// Inclure votre classe de gestion des réservations
require_once "config.php";



// Vérifier si le formulaire de réservation a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extraire les données soumises par le formulaire en tant que variables
    extract($_POST);
    // Appeler la méthode pour ajouter une nouvelle réservation
    $Reservation->addReservation($client_id, $billet_id, $date_reservation, $etat);
} else {
    // Afficher un message d'erreur si le formulaire n'a pas été soumis
    echo "Erreur : Le formulaire de réservation n'a pas été soumis.";
}
?>
