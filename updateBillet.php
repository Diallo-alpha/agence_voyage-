<?php
// Inclure le fichier config.php et créer un objet de votre classe
require_once "config.php";

// Vérifier si l'identifiant du billet à mettre à jour est passé en paramètre
if(isset($_GET['id'])) {
    $id_billet = $_GET['id'];

    // Instance objet Billet avec l'identifiant récupéré
    $billet = new Billet($connexion, "trajet", 100000, "statut", 1, $id_billet);

    // Appeler la méthode getBillet pour récupérer les détails du billet spécifié
    $billet_details = $billet->getBillet($id_billet);

    // Vérification si le formulaire de mise à jour a été soumis
    if(isset($_POST['submit'])) {
        // Récupérer les nouvelles données du formulaire
        $new_trajet = $_POST['trajet'];
        $new_prix = $_POST['prix'];
        $new_statut = $_POST['statut'];

        // Appeler la méthode updateBillet pour mettre à jour le billet
        $billet->updateBillet($id_billet, $new_trajet, $new_prix, $new_statut);
    }
} else {
    // Rediriger si l'identifiant du billet n'est pas spécifié
    header("Location: ReadBillet.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="read.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le billet</title>
    <link rel="stylesheet" href="updateBillet.css">
     <!-- Inclure la feuille de style Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Inclure le script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<!-- <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="./images/Logo.png" alt="logo"></a>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">AJOUTER UN BILLET</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="ReadBillet.php">LISTE DES BILLETS</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header> -->
    <div class="titre"><h1>Modifier le billet</h1></div>
    <form method="post" action="updateBillet.php?id=<?php echo $id_billet; ?>">
        <input type="hidden" name="id_billet" value="<?php echo $id_billet; ?>">
        <div class="form-group">
            <label for="trajet">Trajet :</label><br>
            <input type="text" id="trajet" name="trajet" value="<?php echo $billet_details->getTrajet(); ?>"><br>
        </div>
        <div class="form-group">
            <label for="prix">Prix :</label><br>
            <input type="text" id="prix" name="prix" value="<?php echo $billet_details->getPrix(); ?>"><br>
        </div>
        <div class="form-group">
        <label for="statut">Statut :</label>
        <select id="statut" name="statut" required>
            <option value="disponible" <?php if ($billet_details->getStatut() == "disponible") echo "selected"; ?>>Disponible</option>
            <option value="indisponible" <?php if ($billet_details->getStatut() == "indisponible") echo "selected"; ?>>Indisponible</option>
        </select>
        </div>

        <div class="bouton">
            <button type="submit" name="submit">Mettre à jour</button>
        </div>
    </form>


    
</body>
</html>
