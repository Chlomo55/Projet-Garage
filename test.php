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

$minPrice = $_POST['minPrice'];
$maxPrice = $_POST['maxPrice'];
$minYear = $_POST['minYear'];
$maxYear = $_POST['maxYear'];
$minKm = $_POST['minKm'];
$maxKm = $_POST['maxKm'];

$stmt = $pdo->prepare("SELECT * FROM voitures WHERE prix BETWEEN :minPrice AND :maxPrice AND annee BETWEEN :minYear AND :maxYear AND km BETWEEN :minKm AND :maxKm");
$stmt->execute(['minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'minYear' => $minYear, 'maxYear' => $maxYear, 'minKm' => $minKm, 'maxKm' => $maxKm]);

echo "<div class='container'>";
echo "<div class='row justify-content-center'>"; // Crée une nouvelle ligne pour les voitures


while ($row = $stmt->fetch()) {
    $imageData = base64_encode($row['image_url']);

    // Formatage des km et du prix
    $formattedKm = number_format($row['km'], 0, '', ' ');
    $formattedPrice = number_format($row['prix'], 0, '', ' ');

    echo "<div class='col-lg-4 col-md-6 col-sm-12 mb-4'>";
    echo "<div class='card h-100'>";
    echo "<img class='card-img-top' src='data:image/jpeg;base64," . $imageData . "' alt='" . $row['modele'] . "'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . $row['marque'] . " " . $row['modele'] . "</h5>";
    echo "<p class='card-text'>" . $formattedKm . " km |  " . $row['energie'] . " | ".$row['annee']."</p>";
    echo "<p class='card-text'>" . $formattedPrice . "€</p>"; // Utilisez $formattedPrice ici
    echo "<button><a href='details.php?id=" . $row['id'] . "'>Details</a></button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

// ... (reste du code)


echo "</div>"; // Fin de la ligne
echo "</div>"; // Fin du conteneur
