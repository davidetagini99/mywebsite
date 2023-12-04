document.addEventListener("DOMContentLoaded", function() {
    var dropDownMenuList = document.getElementById("dropDownMenuList"), circleImageDropDown = document.getElementById("user-menu-button");

    dropDownMenuList.style.display = "none";

    circleImageDropDown.addEventListener("click", function() {
        dropDownMenuList.style.display = "flex";
    });
});