<?php
require_once "config.php";

if(isset($_GET['id'])) {
    $id_reservation = $_GET['id'];

    try {
        if(!isset($connexion)) {
            throw new Exception("Erreur de connexion à la base de données");
        }

        $query = "SELECT * FROM reservation WHERE id = :id";
        $statement = $connexion->prepare($query);

        if(!$statement) {
            throw new Exception("Erreur de préparation de la requête");
        }

        $statement->bindParam(':id', $id_reservation, PDO::PARAM_INT);
        $statement->execute();

        $reservation_details = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$reservation_details) {
            throw new Exception("Réservation introuvable");
        }

        if(isset($_POST['submit'])) {
            $reservation_id = $_POST['reservation_id'];
            $nouvel_etat = $_POST['nouvel_etat'];       

            $Reservation->updateEtatReservation($id_reservation, $nouvel_etat);

            header("Location: ReadReservation.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur PDO : " . $e->getMessage();
        exit();
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
        exit();
    }
} else {
    header("Location: ReadReservation.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier ma Réservation</title>
    <link rel="stylesheet" href="updateReservation.css">
     <!-- Inclure la feuille de style Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Inclure le script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="titre"><h1>Modifier l'état de ma Réservation</h1></div>
<form action="" method="post">
    <input type="hidden" name="reservation_id" value="<?php echo $id_reservation; ?>">
    
    <div class="form-group">
    <label for="nouvel_etat">Nouvel état  :</label>
    <select id="nouvel_etat" name="nouvel_etat">
        <option value="confirmé" <?php if (isset($reservation_details['etat']) && $reservation_details['etat'] == "confirmé") echo "selected"; ?>>Confirmée</option>
        <option value="en attente" <?php if (isset($reservation_details['etat']) && $reservation_details['etat'] == "en attente") echo "selected"; ?>>En Attente</option>
        <option value="annulé" <?php if (isset($reservation_details['etat']) && $reservation_details['etat'] == "annulé") echo "selected"; ?>>Annulée</option>
    </select><br>
    </div>
    
    <button type="submit" name="submit">Modifier l'état</button>

</form>
</body>
</html>
