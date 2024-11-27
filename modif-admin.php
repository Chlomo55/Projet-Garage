<?php
require_once('connection.php');

if (isset($_POST['select'])) {
    $id = $_POST['id'];
    $stmt = $bdd->prepare("SELECT * FROM voitures WHERE id = ?");
    $stmt->execute([$id]);
    $voiture = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $stmt = $bdd->prepare("UPDATE voitures SET description = ? WHERE id = ?");
    $stmt->execute([$description, $id]);
    $message = "Description mise à jour avec succès!";
}

$stmt = $bdd->prepare("SELECT * FROM voitures");
$stmt->execute();
$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Sélectionner une voiture pour la modification -->
<form method="post">
    <select name="id" onchange="this.form.submit()">
        <option value="">Sélectionnez une voiture</option>
        <?php foreach ($voitures as $voiture): ?>
            <option value="<?php echo $voiture['marque']; ?>">
            <br>
            <?php echo $voiture['description']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" name="select" value="Sélectionner">
</form>

<!-- Formulaire de modification de la description -->
<?php if (isset($voiture)): ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $voiture['id']; ?>">
        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $voiture['description']; ?></textarea>
        <input type="submit" name="update" value="Mettre à jour">
    </form>
<?php endif; ?>

<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
