document.addEventListener("DOMContentLoaded", function() {
    let userMenuButton = document.getElementById("user-menu-button");

    let userMenu = document.getElementById("user-menu");

    userMenuButton.style.display = "none";

    userMenu.style.display = "none";

    let notificationButton = document.getElementById("notification-button");

    notificationButton.style.display = "none";

    let dropMenuButton = document.getElementById("drop-menu-button");
    
    let dropDownMenu = document.getElementById("drop-down-menu");

    dropDownMenu.style.display = "none";

    dropMenuButton.addEventListener("click", function() {
        if (dropDownMenu.style.display === "none" || dropDownMenu.style.display === "") {
            dropDownMenu.style.display = "flex";
          } else {
            dropDownMenu.style.display = "none";
          }
    });

    let mobileMenu = document.getElementById("mobile-menu");

    mobileMenu.style.display = "none"; 

    let burgerMenuButton = document.getElementById("burger-menu-button");

    burgerMenuButton.addEventListener("click", function() {
        if(mobileMenu.style.display === "none" || mobileMenu.style.display === "") {
            mobileMenu.style.display = "block";
        }
        else {
            mobileMenu.style.display = "none";
        }
    }); // manca l'apertura e la chiusura del menu dropdown

    let dropDownMobileMenu = document.getElementById("drop-down-mobile-menu");

    dropDownMobileMenu.style.display = "none";

    let dropDownMobileButton = document.getElementById("drop-down-mobile-button");

    dropDownMobileButton.addEventListener("click", function() {
        if(dropDownMobileMenu.style.display === "none" || dropDownMobileMenu.style.display === "") {
            dropDownMobileMenu.style.display = "block";
        }
        else {
            dropDownMobileMenu.style.display = "none";
        }
    });
});