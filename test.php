<?php
require_once 'script.php';

// Récupération des paramètres GET
$minPrice = $_GET['minPrice'] ?? 0;
$maxPrice = $_GET['maxPrice'] ?? 50000;
$minYear = $_GET['minYear'] ?? 1990;
$maxYear = $_GET['maxYear'] ?? date('Y');
$minKm = $_GET['minKm'] ?? 0;
$maxKm = $_GET['maxKm'] ?? 500000;
$sort = $_GET['sort'] ?? '';

// Construction de la requête SQL
$query = "SELECT * FROM voitures WHERE prix BETWEEN ? AND ? AND annee BETWEEN ? AND ? AND km BETWEEN ? AND ?";

// Ajout des tris
switch ($sort) {
    case 'price_asc':
        $query .= " ORDER BY prix ASC";
        break;
    case 'price_desc':
        $query .= " ORDER BY prix DESC";
        break;
    case 'km_asc':
        $query .= " ORDER BY km ASC";
        break;
    case 'km_desc':
        $query .= " ORDER BY km DESC";
        break;
    case 'date_desc':
        $query .= " ORDER BY id DESC";
        break;
    case 'date_asc':
        $query .= " ORDER BY id ASC";
        break;
    default:
        $query .= " ORDER BY id ASC"; // Par défaut
        break;
}

// Préparation et exécution
$stmt = $pdo->prepare($query);
$stmt->execute([$minPrice, $maxPrice, $minYear, $maxYear, $minKm, $maxKm]);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichage des résultats
if (empty($cars)) {
    echo "<p>Aucune voiture ne correspond à vos critères.</p>";
} else {
    foreach ($cars as $car) {
        $image = !empty($car['image_url']) ? "data:image/jpeg;base64," . base64_encode($car['image_url']) : 'path/to/default-image.jpg';
        echo "<div class='col'>
                <div class='card h-100'>
                    <img src='{$image}' class='card-img-top' alt='{$car['marque']}'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$car['marque']} - {$car['modele']}</h5>
                        <p class='card-text'>{$car['energie']} | {$car['annee']} | " . number_format($car['prix'], 0, '', ' ') . " €</p>
                    </div>
                </div>
            </div>";
    }
}
