document.addEventListener("DOMContentLoaded", function() {
    var dropDownMenuList = document.getElementById("dropDownMenuList"), circleImageDropDown = document.getElementById("user-menu-button");

    dropDownMenuList.style.display = "none";

    circleImageDropDown.addEventListener("click", function() {
        dropDownMenuList.style.display = (dropDownMenuList.style.display === "flex") ? "none" : "flex";
    });

    let mobileMenuIcon = document.getElementById("openMobileMenu");

    let mobileMenuList = document.getElementById("mobile-menu");

    mobileMenuList.style.display = "none";

    mobileMenuIcon.addEventListener("click", function() {
        mobileMenuList.style.display = (mobileMenuList.style.display === "block") ? "none" : "block";
    });
});