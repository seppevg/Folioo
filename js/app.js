function triggerClick() {
    document.querySelector('#profile-picture').click();
}

function displayImage(e) {
    if (e.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.querySelector("#profile-display").setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}

let burger = document.querySelector(".modal-button");
let modal = document.getElementById("modal");
let x = document.querySelector(".modal-close");
burger.addEventListener("click", function () {
    modal.classList.toggle("display");
});

x.addEventListener("click", function () {
    modal.classList.remove("display");
});