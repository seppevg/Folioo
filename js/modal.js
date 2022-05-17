
let bgr = document.querySelector("#dots-modal");
if (bgr !== null) {
    let modal1 = document.getElementById("modaldots");
    let xx = document.querySelector(".modal-close");
    bgr.addEventListener("click", function () {
        modal1.classList.toggle("display");
    });

    xx.addEventListener("click", function () {
        modal1.classList.remove("display");
    });
}

let burgercheck = document.querySelector("#burgercheck");
if (burgercheck !== null) {
    let modalburger = document.getElementById("modalburger");
    let xclose = document.querySelector("#xclose");
    burgercheck.addEventListener("click", function () {
        modalburger.classList.toggle("display");
    });

    xclose.addEventListener("click", function () {
        modalburger.classList.remove("display");
    });
}

let modal_btn_ep = document.querySelector("#modal_btn_ep");
if (modal_btn_ep !== null) {
    let modal_ep = document.getElementById("modal_ep");
    let modal_close_ep = document.querySelector("#modal_close_ep");
    modal_btn_ep.addEventListener("click", function () {
        modal_ep.classList.toggle("display");
    });

    modal_close_ep.addEventListener("click", function () {
        modal_ep.classList.remove("display");
    });
}

let modal_btn_add = document.querySelector("#modal_btn_add");
if (modal_btn_add !== null) {
    let modal_add = document.getElementById("modal_add");
    let modal_close_add = document.querySelector("#modal_close_add");
    modal_btn_add.addEventListener("click", function () {
        modal_add.classList.toggle("display");
    });

    modal_close_add.addEventListener("click", function () {
        modal_add.classList.remove("display");
    });
}

let modal_btn_pd = document.querySelector("#modal_btn_pd");
if (modal_btn_pd !== null) {
    let modal_pd = document.getElementById("modal_pd");
    let modal_close_pd = document.querySelector("#modal_close_pd");
    modal_btn_pd.addEventListener("click", function () {
        modal_pd.classList.toggle("display");
    });

    modal_close_pd.addEventListener("click", function () {
        modal_pd.classList.remove("display");
    });
}

let modal_btn_pdown = document.querySelector("#modal_btn_pdown");
if (modal_btn_pdown !== null) {
    let modal_pdown = document.getElementById("modal_pdown");
    let modal_close_pdown = document.querySelector("#modal_close_pdown");
    modal_btn_pdown.addEventListener("click", function () {
        modal_pdown.classList.toggle("display");
    });

    modal_close_pdown.addEventListener("click", function () {
        modal_pdown.classList.remove("display");
    });
}


let modal_btn_report_post1 = document.querySelector("#modal_btn_report_post1");
if (modal_btn_report_post1 !== null) {
    let modal_container_desktop = document.querySelector(".modal-container-desktop");
    let modal_report_post1 = document.getElementById("modal_report_post1");
    modal_btn_report_post1.addEventListener("click", function () {
        modal_report_post1.classList.toggle("display");
        if (modal_container_desktop.style.display == 'block') {
            modal_container_desktop.style.display = 'none'
        } else {
            modal_container_desktop.style.display = 'block'
        }
    });
}


let modal_btn_report_post2 = document.querySelector("#modal_btn_report_post2");
if (modal_btn_report_post2 !== null) {
    let modal_report_post2 = document.getElementById("modal_report_post2");
    let modal_close_report_post2 = document.querySelector("#modal_close_report_post2");
    modal_btn_report_post2.addEventListener("click", function () {
        modal_report_post2.classList.toggle("display");
    });

    modal_close_report_post2.addEventListener("click", function () {
        modal_report_post2.classList.remove("display");
    });
}