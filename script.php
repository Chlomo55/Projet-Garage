<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    // Fonction pour rafraîchir automatiquement la page avec les nouveaux paramètres de filtrage
    function filtrerVoitures() {
        const minPrix = $("#slider-range").slider("values", 0);
        const maxPrix = $("#slider-range").slider("values", 1);
        const minKm = $("#slider-range1").slider("values", 0);
        const maxKm = $("#slider-range1").slider("values", 1);
        const minAnnee = $("#slider-range2").slider("values", 0);
        const maxAnnee = $("#slider-range2").slider("values", 1);

        const url = `<?php echo $_SERVER['PHP_SELF'] ?>?minPrix=${minPrix}&maxPrix=${maxPrix}&minKm=${minKm}&maxKm=${maxKm}&minAnnee=${minAnnee}&maxAnnee=${maxAnnee}`;
        window.location.href = url;
    }

    $(document).ready(() => {

        $('#div-filter-elements').hide();
        $('#filtrer-button-input').click(function(){
        $('#div-filter-elements').show()
        })

        // Initialiser les sliders avec les valeurs par défaut
        const params = new URLSearchParams(window.location.search);
        const minPrix = parseInt(params.get("minPrix")) || 10000;
        const maxPrix = parseInt(params.get("maxPrix")) || 30000;
        const minKm = parseInt(params.get("minKm")) || 50000;
        const maxKm = parseInt(params.get("maxKm")) || 120000;
        const minAnnee = parseInt(params.get("minAnnee")) || 2002;
        const maxAnnee = parseInt(params.get("maxAnnee")) || 2018;

        // Prix
        $("#slider-range").slider({
            range: true,
            min: 1000,
            max: 50000,
            step: 100,
            values: [minPrix, maxPrix],
            slide: function (event, ui) {
                $("#amount").val(ui.values[0].toLocaleString() + "€ - " + ui.values[1].toLocaleString() + "€");
            },
            change: function () {
                filtrerVoitures(); // Rafraîchir la page lorsque le slider est modifié
            }
        });

        // Kilométrage
        $("#slider-range1").slider({
            range: true,
            min: 1000,
            max: 300000,
            step: 1000,
            values: [minKm, maxKm],
            slide: function (event, ui) {
                $("#km").val(ui.values[0].toLocaleString() + " km - " + ui.values[1].toLocaleString() + " km");
            },
            change: function () {
                filtrerVoitures(); // Rafraîchir la page lorsque le slider est modifié
            }
        });

        // Année
        $("#slider-range2").slider({
            range: true,
            min: 1990,
            max: new Date().getFullYear(),
            step: 1,
            values: [minAnnee, maxAnnee],
            slide: function (event, ui) {
                $("#annee").val(ui.values[0] + " - " + ui.values[1]);
            },
            change: function () {
                filtrerVoitures(); // Rafraîchir la page lorsque le slider est modifié
            }
        });

        // Afficher les valeurs initiales dans les champs de texte
        $("#amount").val(minPrix.toLocaleString() + "€ - " + maxPrix.toLocaleString() + "€");
        $("#km").val(minKm.toLocaleString() + " km - " + maxKm.toLocaleString() + " km");
        $("#annee").val(minAnnee + " - " + maxAnnee);
    });
</script>