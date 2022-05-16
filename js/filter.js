let burger = document.querySelector(".modal-button");
let desktopFilter = document.querySelector("#desktop-filter");
let filterOptions = document.querySelector(".filter-options");
let modal = document.getElementById("modal");
let x = document.querySelector(".modal-close");
if(burger !== null){
burger.addEventListener("click", function (e) {
    e.preventDefault();
    modal.classList.toggle("display");
    desktopFilter.classList.toggle("display");
    filterOptions.classList.toggle("display");
});
}

if(x !== null){
x.addEventListener("click", function (e) {
    e.preventDefault();
    modal.classList.remove("display");
});
}