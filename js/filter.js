let burger = document.querySelector(".modal-button");
let desktopFilter = document.querySelector("#desktop-filter");
let modal = document.getElementById("modal");
let x = document.querySelector(".modal-close");
burger.addEventListener("click", function (e) {
    e.preventDefault();
    modal.classList.toggle("display");
    desktopFilter.classList.toggle("display");
    modal.classList.toggle("active");
});

x.addEventListener("click", function (e) {
    e.preventDefault();
    modal.classList.remove("display");
});