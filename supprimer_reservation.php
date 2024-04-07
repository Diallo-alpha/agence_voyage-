<?php
require_once "config.php"; 
require_once "Reservation.php";

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $Reservation = new Reservation($connexion, null, null, null, null);
    if($Reservation->deleteReservation($id)) 
        {
        header("Location: ReadReservation.php");
        exit();
        } else {
       
        echo '<div class="alert alert-danger" role="alert">Une erreur s\'est produite lors de la suppression de la réservation.</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Identifiant de réservation non spécifié.</div>';
}
?>
