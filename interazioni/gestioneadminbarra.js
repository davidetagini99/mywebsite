document.addEventListener("DOMContentLoaded", function() {
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
    });
});