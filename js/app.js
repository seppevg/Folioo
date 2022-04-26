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

let tags = document.querySelector("#input-tags").value
if (tags === "") {
    // console.log("tags are empty");
    tags = [];
} else {
    // console.log("tags zijn:" + tags);
    //Convert string from input field to array separated by commas
    tags = tags.split(',');
}

function addTag(e) {
    e.preventDefault();
    //checks if the error key is pressed
    let code = (e.keycode ? e.keycode : e.which);
    if (code != 13) {
        return;
    }
    let tag = e.target.value.trim();
    //checks if the tag is not empty or is not already in the list
    if (tag.length < 1 || tags.includes(tag)) {
        e.target.value = "";
        return;
    }

    let index = tags.push(tag);
    let tagItem = document.createElement("div");
    tagItem.classList.add("tag-item");
    tagItem.innerHTML = `
        <span class="delete-btn" onclick="deleteTag(this, '${tag}')">
        &times;
        </span>
        <span>#${tag}</span>
    `;
    document.querySelector(".tag-input .tag-list").appendChild(tagItem);
    document.querySelector("#input-tags").value = tags;
    e.target.value = "";
}

function deleteTag(ref, tag) {
    let parent = ref.parentNode.parentNode;
    parent.removeChild(ref.parentNode);

    let index = tags.indexOf(tag);
    tags.splice(index, 1);
    document.querySelector("#input-tags").value = tags;
}

document.querySelector(".tags-input").addEventListener("keyup", addTag);