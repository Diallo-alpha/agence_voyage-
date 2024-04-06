<?php
// Inclure le fichier config.php et créer un objet de votre classe
require_once "config.php";

// Instancier votre objet Billet
$billet = new Billet($connexion, "trajet", 100000, "statut", 1);

// Appeler la méthode readBillet pour récupérer les billets
$billets = $billet->readBillet();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des billets</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #dddddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e2e2e2;
        }
    </style>
</head>
<body>
    <h1>Liste des billets</h1>
    <table >
        <thead>
            <tr>
                <th>Trajet</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Email de l'agent</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($billets as $billet): ?>
            <tr>
                <td><?php echo $billet['trajet']; ?></td>
                <td><?php echo $billet['prix']; ?></td>
                <td><?php echo $billet['statut']; ?></td>
                <td><?php echo $billet['email']; ?></td>
                <!-- <td><a href="DeleteBillet.php?id=<?php echo $billet['id']; ?>"><i class="fas fa-trash-alt"></i></a> </td> -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
