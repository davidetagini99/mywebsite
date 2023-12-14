document.addEventListener("DOMContentLoaded", function() {
    let gotoAreaRiservata = document.getElementById("gotoAreaRiservata");

    gotoAreaRiservata.addEventListener("click", function() {
        window.location.href = "../mywebsite/pagine/area_riservata.php";
    });

    let activateDarkMode = document.getElementById("activateDarkMode");

    activateDarkMode.addEventListener("click", function() {
        alert("Dark mode");
    });
});