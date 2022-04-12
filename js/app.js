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

let projectStart = 0;
document.querySelector("#loadMoreProjectsButton").addEventListener("click", e => {
    e.preventDefault(); //reload vermijden
    projectStart += 5;
    //Deze waarde bepaalt vanaf welke startpositie de 5 volgende posts uit de database gehaald moeten worden

    let data = new FormData();
    data.append("projectStart", projectStart);

    fetch('./ajax/load_projects.php', {
        method: 'POST',
        body: data,
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                let projectData = data.data.projects;
                if (projectData.length > 0) {
                    projectData.forEach(project => {
                        let userId = project['user_id'];

                        let dataUser = new FormData();
                        dataUser.append("userId", userId);
                        //console.log(dataUser);
                        fetch('./ajax/load_userinfo.php', {
                            method: 'POST',
                            body: dataUser,
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === "success") {
                                    let userData = data.data.info;

                                    let post = `
                                    <article class="project">
                                        <img class="project-picture" src="./assets/no-uploads.svg" alt="project image">
                                        <div class="project-info">
                                            <a class="project-author" href="#">
                                                <img class="project-author-picture" src="./uploads/${userData['image']}" alt="profile picture">
                                                <h4 class="project-author-username">${userData['username']}</h4>
                                            </a>
                                            <div class="project-interactions">
                                                <div class="project-interactions-like">
                                                    <img class="like-icon" src="./assets/heart-empty.svg" alt="heart or like icon">
                                                    <h4>number</h4>
                                                </div>
                                                <div class="project-interactions-comment">
                                                    <img class="comment-icon" src="./assets/comment.svg" alt="comment icon">
                                                    <h4>number</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </article>`;

                                    document.querySelector(".allPosts").innerHTML += post;
                                }
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                    });
                } else {
                    let post = `<h4 class="project-author-username" style="margin-left: 2em">
                    That's it! You reached the bottom!
                    </h4>`;
                    document.querySelector(".allPosts").innerHTML += post;
                    document.querySelector("#loadMoreProjectsButton").style.visibility = "hidden";
                }
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});

let burger = document.querySelector(".modal-button");
let modal = document.getElementById("modal");
let x = document.querySelector(".modal-close");
burger.addEventListener("click", function () {
    modal.classList.toggle("display");
});

x.addEventListener("click", function () {
    modal.classList.remove("display");
});