<?php
$host = 'localhost';
$db   = 'ecf-garage';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $commentaire = $_POST['commentaire'];
    $note = $_POST['note'];

    try {
        $stmt = $pdo->prepare("INSERT INTO temoignages (nom, commentaire, note) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $commentaire, $note]);
        echo "Témoignage soumis avec succès!";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

