$(function() {
    function fetchCars(minPrice, maxPrice, minYear, maxYear, minKm, maxKm) {
        $.ajax({
            url: 'test.php',
            method: 'POST',
            data: {
                minPrice: minPrice,
                maxPrice: maxPrice,
                minYear: minYear,
                maxYear: maxYear,
                minKm: minKm,
                maxKm: maxKm
            },
            success: function(data) {
                $('#cars-list').html(data);
            }
        });
    }

    $("#price-range").slider({
        range: true,
        min: 0,
        max: 50000,
        step: 50,
        values: [0, 50000],
        slide: function(event, ui) {
            $("#price-label").text(ui.values[0] + "€ - " + ui.values[1] + "€");
            fetchCars(ui.values[0], ui.values[1], $("#year-range").slider("values", 0), $("#year-range").slider("values", 1), $("#km-range").slider("values", 0), $("#km-range").slider("values", 1));
        }
    });

    $("#year-range").slider({
        range: true,
        min: 1990,
        max: new Date().getFullYear(),
        values: [1990, new Date().getFullYear()],
        slide: function(event, ui) {
            $("#year-label").text(ui.values[0] + " - " + ui.values[1]);
            fetchCars($("#price-range").slider("values", 0), $("#price-range").slider("values", 1), ui.values[0], ui.values[1], $("#km-range").slider("values", 0), $("#km-range").slider("values", 1));
        }
    });

    $("#km-range").slider({
        range: true,
        min: 0,
        max: 500000,
        step: 100,
        values: [0, 500000],
        slide: function(event, ui) {
            $("#km-label").text(ui.values[0] + "km - " + ui.values[1] + "km");
            fetchCars($("#price-range").slider("values", 0), $("#price-range").slider("values", 1), $("#year-range").slider("values", 0), $("#year-range").slider("values", 1), ui.values[0], ui.values[1]);
        }
    });

    // Initialisation des labels
    $("#price-label").text($("#price-range").slider("values", 0) + "€ - " + $("#price-range").slider("values", 1) + "€");
    $("#year-label").text($("#year-range").slider("values", 0) + " - " + $("#year-range").slider("values", 1));
    $("#km-label").text($("#km-range").slider("values", 0) + "km - " + $("#km-range").slider("values", 1) + "km");

    // Charger toutes les voitures au début
    fetchCars(500, 50000, 1990, new Date().getFullYear(), 0, 500000);
});

$(document).ready(() => {
    $('#button-filtrer').show();
    $('#slide-div').hide();
    $('#masquer_filtres').hide();

    $('#button-filtrer').click(function() { // Corrigé la syntaxe ici
        $('#slide-div').show(1000);
        $('#button-filtrer').hide();
        $('#masquer_filtres').show();
    });

    $('#masquer_filtres').click(function() {
        $('#slide-div').hide(1000);
        $('#button-filtrer').show();
        $('#masquer_filtres').hide();
    })
});