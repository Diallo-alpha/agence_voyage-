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
        
        // Expression régulière pour valider le format du trajet (par exemple, "Dakar - Dubai")
        $regex_trajet = "/^[a-zA-Z\s]+(\s*-\s*[a-zA-Z\s]+)+$/";

        // Expression régulière pour valider le prix (par exemple, un nombre décimal positif)
        $regex_prix = "/^\d+(\.\d+)?$/";

        // Vérifier si le trajet et le prix correspondent aux expressions régulières
        if (preg_match($regex_trajet, $trajet) && preg_match($regex_prix, $prix)) {
            // Préparation de la requête pour récupérer l'ID de l'admin à partir de l'email
            $query = "SELECT id FROM admin WHERE email = :email";
            $stmt = $connexion->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $id_admin = $stmt->fetchColumn();
            
            // Appel de la méthode addBillet de votre objet Billet pour ajouter le billet
            $billet= new Billet($connexion,1, "trajet", 100000, "statut", 1);
            $billet->addBillet($trajet, $prix, $statut, $id_admin);
        } else {
            // Les données ne correspondent pas aux expressions régulières, afficher un message d'erreur
            echo "<script>alert('Erreur : Veuillez saisir un trajet valide (par exemple, \"Dakar - Dubai\") et un prix valide.');</script>";
        }
    }
} catch (PDOException $e) {
    // Gestion des erreurs
    echo "Erreur lors de l'ajout du billet : " . $e->getMessage();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
     <!-- Inclure la feuille de style Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Inclure le script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<style>
    body{
        background-color: #F5F5F5;
    }
</style>
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="./images/Logo.png" alt="logo"></a>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Ajouter un Billet</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="ReadBillet.php">Liste des Billets</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link"aria-current="page"href="reservation_billet.php">Liste des Réservations</a>
                        </li>
                </ul>
                </div>
            </div>
        </nav>
    </header> 
    <main>
       
        <section class="destinations">
             <h1>Ajouter un billet</h1>
             <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="trajet">Trajet :</label>
                    <input type="text" id="trajet" name="trajet" required>
                </div>
                <div class="form-group">
                    <label for="prix">Prix :</label>
                    <input type="text" id="prix" name="prix" required>
                </div>
                <div class="form-group">
                    <label for="statut">Statut :</label>
                    <select id="statut" name="statut" required>
                        <option value="disponible">Disponible</option>
                        <option value="indisponible">Indisponible</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email de l'Admin :</label>
                    <select id="email" name="email" required>
                        <?php foreach ($admins as $admin): ?>
                            <option value="<?php echo $admin['email']; ?>"><?php echo $admin['email']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="bouton">
                    <button type="submit">Ajouter</button>
                </div>
            </form>
            
        </section>

    </main>
    <footer>
        <div class="container">
            
            <div class="copyright">
            <p>&copy; 2024 Réservez vos billets</p>
            </div>
        </div>
</footer>

   
</body>
</html>