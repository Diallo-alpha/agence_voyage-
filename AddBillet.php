<?php
require_once "config.php";

try {
    // Requête SQL préparée pour récupérer les administrateurs
    $sql_admins = "SELECT id, email FROM admin";
    $stmt_admins = $connexion->prepare($sql_admins);
    $stmt_admins->execute();
    $admins = $stmt_admins->fetchAll();
} catch (PDOException $e) {
    // Gestion des erreurs
    echo "Erreur lors de la récupération des administrateurs : " . $e->getMessage();
}

// Traitement du formulaire lorsqu'il est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire avec extract()
    extract($_POST);

    try {
        // Appel de la méthode addBillet de votre objet Admin pour ajouter le billet
        
        $admin->addBillet($trajet, $prix, $statut, $id_admin);
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de l'ajout du billet : " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un billet</title>
</head>
<body>
    <h1>Ajouter un billet</h1>
    <form action="" method="POST">

        <label for="trajet">Trajet :</label>
        <input type="text" id="trajet" name="trajet" required><br><br>

        <label for="prix">prix :</label>
        <input type="text" id="prix" name="prix" required><br><br>
        
        <label for="statut">Statut :</label>
        <select id="statut" name="statut" required>
            <option value="disponible">Disponible</option>
            <option value="indisponible">Indisponible</option>
        </select><br><br>
        
        
        <label for="idAdmin">ID Admin :</label>
        <select id="idAdmin" name="idAdmin">
            <?php foreach ($admins as $admin): ?>
                <option value="<?php echo $admin['id']; ?>"><?php echo $admin['email']; ?></option>
            <?php endforeach; ?>
        </select><br><br>



        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
