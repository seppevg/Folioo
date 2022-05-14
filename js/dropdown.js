let arrowMobile = document.querySelector(".dropdown-filter-mobile");
let dropdownMobile = document.querySelector(".dropdown-menu-mobile");
arrowMobile.addEventListener("click", function () {
    dropdownMobile.classList.toggle("active");
});

let arrowDesktop = document.querySelector(".dropdown-filter-desktop");
let dropdownDesktop = document.querySelector(".dropdown-menu-desktop");
arrowDesktop.addEventListener("click", function () {
    dropdownDesktop.classList.toggle("active");
});

let arrowProfileDesktop = document.querySelector(".dropdown-button-profile");
let dropdownProfileDesktop = document.querySelector(".dropdown-menu-profile");
arrowProfileDesktop.addEventListener("click", function () {
    dropdownProfileDesktop.classList.toggle("hidden");
});