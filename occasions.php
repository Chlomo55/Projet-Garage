<?php
include_once('header.php');
require_once('connection.php');
include_once('style-filtres.php');
?>
<body>
  <div id="button-filtrer" class="text-center button-style">
    <input type="button" value="Filtrer">
  </div>
<div id="slide-div">
 <div class="slide_sous_div">
    <label for="price-range">Prix:</label>
    <div id="price-range" class="color-filtre"></div>
    <span id="price-label"></span>
</div>

<div class="slide_sous_div">
    <label for="year-range">Année:</label>
    <div id="year-range" class="color-filtre"></div>
    <span id="year-label"></span>
</div>

<div class="slide_sous_div">
    <label for="km-range">Kilométrage:</label>
    <div id="km-range" class="color-filtre"></div>
    <span id="km-label"></span>
</div> 
</div>
<div id="masquer_filtres" class="text-center button-style">
  <input type="button" value="Masquer les filtres">
</div>

<div id="cars-list">
    <!-- Les voitures filtrées seront affichées ici -->
</div>

<script src="script.js"></script>
</body>


<?php include_once('footer.php');?>
