let burger = document.querySelector(".modal-button");
let modal = document.getElementById("modal");
let x = document.querySelector(".modal-close");
burger.addEventListener("click", function (e) {
    e.preventDefault();
    modal.classList.toggle("display");
});

x.addEventListener("click", function (e) {
    e.preventDefault();
    modal.classList.remove("display");
});