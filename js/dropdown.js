let arrow = document.querySelector(".dropdown-button");
let dropdown = document.querySelector(".dropdown-menu");
//console.log(dropdown);

arrow.addEventListener("click", function() {
    //console.log("👌");
    dropdown.classList.toggle("active");
 
});

