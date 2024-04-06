<?php
require_once "config.php";

try {
    // Requête SQL préparée pour récupérer les administrateurs
    $sql_admins = "SELECT id, email FROM admin";
    $stmt_admins = $connexion->prepare($sql_admins);
    $stmt_admins->execute();
    $admins = $stmt_admins->fetchAll(PDO::FETCH_ASSOC);
    
    // Traitement du formulaire lorsqu'il est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $trajet = $_POST['trajet'];
        $prix = $_POST['prix'];
        $statut = $_POST['statut'];
        $email = $_POST['email'];
        
        // Préparation de la requête pour récupérer l'ID de l'admin à partir de l'email
        $query = "SELECT id FROM admin WHERE email = :email";
        $stmt = $connexion->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $id_admin = $stmt->fetchColumn();
        
        // Appel de la méthode addBillet de votre objet Billet pour ajouter le billet
        $billet= new Billet($connexion,"trajet", 100000, "statut", 1);
        $billet->addBillet($trajet, $prix, $statut, $id_admin);
    }
} catch (PDOException $e) {
    // Gestion des erreurs
    echo "Erreur lors de l'ajout du billet : " . $e->getMessage();
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
        <label for="prix">Prix :</label>
        <input type="text" id="prix" name="prix" required><br><br>
        <label for="statut">Statut :</label>
        <select id="statut" name="statut" required>
            <option value="disponible">Disponible</option>
            <option value="indisponible">Indisponible</option>
        </select><br><br>
        <label for="email">Email de l'Admin :</label>
        <select id="email" name="email" required>
            <?php foreach ($admins as $admin): ?>
                <option value="<?php echo $admin['email']; ?>"><?php echo $admin['email']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
