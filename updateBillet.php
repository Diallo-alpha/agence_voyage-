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
</head>
<body>
    <h1>Modifier le billet</h1>
    <form method="post" action="updateBillet.php?id=<?php echo $id_billet; ?>">
        <input type="hidden" name="id_billet" value="<?php echo $id_billet; ?>">
        <label for="trajet">Trajet :</label><br>
        <input type="text" id="trajet" name="trajet" value="<?php echo $billet_details->getTrajet(); ?>"><br>
        <label for="prix">Prix :</label><br>
        <input type="text" id="prix" name="prix" value="<?php echo $billet_details->getPrix(); ?>"><br>
        <label for="statut">Statut :</label><br>
        <input type="text" id="statut" name="statut" value="<?php echo $billet_details->getStatut(); ?>"><br><br>
        <input type="submit" name="submit" value="Mettre à jour">
    </form>
</body>
</html>