<?php
require_once("connection.php");

// Informations de l'administrateur
$email = "admin@example.com"; // Remplacez par l'email de l'admin
$password = "Admin1234"; // Remplacez par le mot de passe souhaité

// Hasher le mot de passe
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insérer l'admin dans la base de données
$sql = "INSERT INTO users (email, pass, role) VALUES (:email, :pass, 'admin')";

$query = $bdd->prepare($sql);
$query->bindValue(":email", $email, PDO::PARAM_STR);
$query->bindValue(":pass", $hashed_password, PDO::PARAM_STR);

$query->execute();

echo "Administrateur inséré avec succès!";
?>
