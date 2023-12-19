document.addEventListener("DOMContentLoaded", function() {
    let goToAreaRiservata = document.getElementById("goto-area-riservata");

    goToAreaRiservata.addEventListener("click", function() {
        window.location.href = "../Il mio sito web/pagine/area-riservata.php";
    });

    let profiloGitHub = document.getElementById("profilo-github");

    profiloGitHub.addEventListener("click", function() {
        //alert("Ciao");

        //console.log("Ciao");

        window.location.href = "../Il mio sito web/pagine/sviluppo-mobile.php";
    });
});