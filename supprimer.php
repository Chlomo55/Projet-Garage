<?php 
require_once('connection.php');
$id = $_GET['id'];
if (isset($_POST['confirm'])) {
    // Supprimez l'entrée de la base de données
    $sql = "DELETE FROM users WHERE id = :id";
    $query = $bdd->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    header('Location: espace-admin.php');
} else {
    // Demandez à l'utilisateur de confirmer la suppression
    echo "Êtes-vous sûr de vouloir supprimer cette entrée ?";
    echo "<form method='post'>";
    echo "<input type='submit' name='confirm' value='Oui'>";
    echo "<a href='espace-admin.php'>Non</a>";
    echo "</form>";
}
