document.addEventListener("DOMContentLoaded", function() {
    let mobileMenuButton = document.getElementById("mobileMenuBtn");
    let mobileMenu = document.getElementById("mobile-menu");

    mobileMenu.style.display = "none";

    mobileMenuButton.addEventListener("click", function() {
        mobileMenu.style.display = (mobileMenu.style.display === "block") ? "none" : "block";
    });
});
