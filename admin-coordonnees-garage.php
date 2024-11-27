<?php 

require_once('connection.php');
include_once('header.php');

// Approuver
if(isset($_POST['action']) && $_POST['action'] == 'approuver' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("UPDATE avis SET approuve = 1 WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

// Rejeter
if(isset($_POST['action']) && $_POST['action'] == 'rejeter' && isset($_POST['id'])) {
    $stmt = $bdd->prepare("DELETE FROM avis WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

$sqlex = 'SELECT * FROM coordonnee';
$recupCoordonnees = $bdd->prepare($sqlex);
$recupCoordonnees->execute();
$Coordonnees = $recupCoordonnees->fetchAll();
?>

<div class="container">
        <div class="row justify-content-center"> <!-- Ajout de justify-content-center pour centrer les éléments de la ligne -->
            <?php
            foreach($Coordonnees as $coordonnee) {?>
                <div class='col-lg-4 col-md-6 col-sm-12 mb-2'> 
                    <div class='card avis mx-1'> 
                        <h3><?=$coordonnee['tel']?></h3>
                        <p><?=$coordonnee['numRue']?></p>
                        <p><?=$coordonnee['rue']?></p>
                        <p><?=$coordonnee['codePostal']?></p>
                        <p><?=$coordonnee['ville']?></p> <?php }?>
                        <!-- <form method="post">
                <input type="hidden" name="action" value="approuver">
                <input type="hidden" name="id" value="<?= $avis['id'] ?>">
                <button type="submit" style="background: green; color: white;">Approuver</button>
            </form> -->
        </div> 
    </div>

<style>
    .avis{
        border: 2px black solid;
        width: 300px;
        margin: 10px;
        border-radius: 15px;
        padding: 10px;
    }
</style>
