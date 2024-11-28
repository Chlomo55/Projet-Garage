<?php require_once 'header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center">Voitures d'</h1>

    <!-- Formulaire de filtres -->
    <form method="GET" action="occasions.php" class="p-3 mb-4 border rounded">
        <h3>Filtres</h3>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="minPrice" class="form-label">Prix minimum (€)</label>
                <input type="number" name="minPrice" id="minPrice" class="form-control" value="<?= htmlspecialchars($_GET['minPrice'] ?? '') ?>" placeholder="0">
            </div>
            <div class="col-md-4">
                <label for="maxPrice" class="form-label">Prix maximum (€)</label>
                <input type="number" name="maxPrice" id="maxPrice" class="form-control" value="<?= htmlspecialchars($_GET['maxPrice'] ?? '') ?>" placeholder="50000">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="minYear" class="form-label">Année minimum</label>
                <input type="number" name="minYear" id="minYear" class="form-control" value="<?= htmlspecialchars($_GET['minYear'] ?? '') ?>" placeholder="1990">
            </div>
            <div class="col-md-4">
                <label for="maxYear" class="form-label">Année maximum</label>
                <input type="number" name="maxYear" id="maxYear" class="form-control" value="<?= htmlspecialchars($_GET['maxYear'] ?? '') ?>" placeholder="<?= date('Y') ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="minKm" class="form-label">Kilométrage minimum (km)</label>
                <input type="number" name="minKm" id="minKm" class="form-control" value="<?= htmlspecialchars($_GET['minKm'] ?? '') ?>" placeholder="0">
            </div>
            <div class="col-md-4">
                <label for="maxKm" class="form-label">Kilométrage maximum (km)</label>
                <input type="number" name="maxKm" id="maxKm" class="form-control" value="<?= htmlspecialchars($_GET['maxKm'] ?? '') ?>" placeholder="500000">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="sort" class="form-label">Trier par</label>
                <select name="sort" id="sort" class="form-control">
                    <option value="" <?= !isset($_GET['sort']) || $_GET['sort'] === '' ? 'selected' : '' ?>>Aucun</option>
                    <option value="price_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'price_asc' ? 'selected' : '' ?>>Prix croissant</option>
                    <option value="price_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'price_desc' ? 'selected' : '' ?>>Prix décroissant</option>
                    <option value="km_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'km_asc' ? 'selected' : '' ?>>Kilométrage croissant</option>
                    <option value="km_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'km_desc' ? 'selected' : '' ?>>Kilométrage décroissant</option>
                    <option value="date_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'date_desc' ? 'selected' : '' ?>>Date (plus récent)</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Chercher</button>
    </form>

    <!-- Liste des voitures -->
    <div id="cars-list" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        require_once 'test.php'; // Le fichier test.php génère les résultats filtrés
        ?>
    </div>
</div>
