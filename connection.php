<?php
try {
    // On se connecte à MySQL
    $bdd = new PDO(dsn: 'mysql:host=localhost;dbname=ecf-garage', username: 'root', password: '');
} catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
}?>



