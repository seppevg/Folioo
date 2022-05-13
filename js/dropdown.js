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

let arrowProfileDesktop1 = document.querySelector(".dropdown-button-profile1");
let dropdownProfileDesktop1 = document.querySelector(".dropdown-menu-profile1");
arrowProfileDesktop1.addEventListener("click", function () {
    dropdownProfileDesktop1.classList.toggle("hidden");
});

let arrowProfileDesktop2 = document.querySelector(".dropdown-button-profile2");
let dropdownProfileDesktop2 = document.querySelector(".dropdown-menu-profile2");
arrowProfileDesktop2.addEventListener("click", function () {
    dropdownProfileDesktop2.classList.toggle("hidden");
});