<section class="reservation">
    <h1>Réserver un billet</h1>
    <?php
    require_once "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserver'])) {
        // Traitement du formulaire de réservation ici
    }

    // Vérifier si un billet a été sélectionné
    if (isset($_POST['id'])) {
        // Récupération des détails du billet sélectionné depuis la base de données
        $billet_id = $_POST['id'];
        $query = "SELECT * FROM billet WHERE id = ?";
        $statement = $connexion->prepare($query);
        $statement->execute([$billet_id]);
        $billet = $statement->fetch(PDO::FETCH_ASSOC);

        // Afficher le formulaire de réservation avec les détails du billet sélectionné
        echo "<form method='post' action='AddReservation.php'>";
        echo "<input type='hidden' name='id' value='" . $billet['id'] . "'>";
        echo "<label for='trajet'>Trajet :</label>";
        echo "<input type='text' id='trajet' name='trajet' value='" . $billet['trajet'] . "' readonly>";
        echo "<label for='prix'>Prix :</label>";
        echo "<input type='text' id='prix' name='prix' value='" . $billet['prix'] . "' readonly>";
        echo "<label for='date'>Date de réservation :</label>";
        echo "<input type='date' id='date' name='date' placeholder='Date de réservation' required>";
        echo "<label for='etat'>État de la réservation :</label>";
        echo "<select id='etat' name='etat' required>
                <option value='confirmé'>Confirmée</option>
                <option value='en attente'>En attente</option>
                <option value='annulé'>Annulée</option>
              </select>";
        echo "<input class='bouton-reserver' type='submit' name='reserver' value='Valider'>";
        echo "</form>";
    } else {
        echo "<p>Aucun billet sélectionné.</p>";
    }
    ?>
</section>
