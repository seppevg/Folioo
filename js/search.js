
document.querySelector(".search").addEventListener("submit", e =>{
    //console.log("👍");
    e.preventDefault();

    let filterSearch = document.querySelector(".selectSearch");
    let filterType = filterSearch.options[filterSearch.selectedIndex].value;

    console.log(filterType);
    window.location = "search.php"

    
});