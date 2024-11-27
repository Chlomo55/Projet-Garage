<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier les autorisations de l'administrateur (tu peux personnaliser cette vérification selon tes besoins)
    $isAdmin = true; // Exemple: ici on suppose que l'utilisateur est un administrateur

    if ($isAdmin) {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=ecf-garage', 'root', '');
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }

        // Vérifier si une image a été téléchargée
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
            

            // Échapper les caractères spéciaux dans les données avant de les insérer dans la requête SQL
            $marque = $_POST['marque'];
            $modele = $_POST['modele'];
            $energie = $_POST['energie'];
            $km = $_POST['km'];
            $annee = $_POST['annee'];
            $prix = $_POST['prix'];
            $description = $_POST['description'];

            // Préparer et exécuter la requête d'insertion
            $stmt = $bdd->prepare("INSERT INTO voitures (image_url, marque, modele, energie, km, annee, prix, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $imageData, PDO::PARAM_LOB);
            $stmt->bindParam(2, $marque);
            $stmt->bindParam(3, $modele);
            $stmt->bindParam(4, $energie);
            $stmt->bindParam(5, $km);
            $stmt->bindParam(6, $annee);
            $stmt->bindParam(7, $prix);
            $stmt->bindParam(8, $description);
            $stmt->execute();

            // Rediriger vers une page de succès ou afficher un message de succès
            header("Location: succes.php");
            exit();
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        echo "Accès non autorisé.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une voiture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur votre administration </h1>
        <h2>Ici vous pouvez ajouter une annonce de voiture d'occasion</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="files" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="marque">Marque</label>
                <input type="text" name="marque" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="modele">Modèle</label>
                <input type="text" name="modele" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="energie">Énergie</label>
                <select name="energie" id="energie" class="form-control">
                    <option value="Choisir">Choisir</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Essence">Essence</option>
                    <option value="GPL">GPL</option>
                    <option value="Gazole">Gazole</option>
                    <option value="Electrique">Electrique</option>
                    <option value="Hybride">Hybride</option>
                </select>
            </div>
            <div class="form-group">
    <label for="km">Kilométrage</label>
    <div class="input-group">
        <input type="number" name="km" class="form-control" required>
        <div class="input-group-append">
            <span class="input-group-text">km</span>
        </div>
    </div>
</div>
            <div class="form-group">
                <label for="annee">Année</label>
                <input type="number" name="annee" class="form-control" required>
            </div>
            <div class="form-group">
    <label for="prix">Prix</label>
    <div class="input-group">
        <input type="number" name="prix" class="form-control" required>
        <div class="input-group-append">
            <span class="input-group-text">€</span>
        </div>
    </div>
</div>
            <div class="form-group">
                <label for="description">Description de la voiture</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group text-center">
                <input type="submit" value="Ajouter" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
<style>
    h1, h2{
        text-align: center;
        color: #17a2b7;
    }
</style>