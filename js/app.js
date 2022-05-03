function triggerClick() {
  document.querySelector("#profile-picture").click();
}

function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      document
        .querySelector("#profile-display")
        .setAttribute("src", e.target.result);
    };
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


let tags;
if (document.querySelector("#input-tags")) {
  tags = document.querySelector("#input-tags").value;
  if (tags === "") {
    // console.log("tags are empty");
    tags = [];
  } else {
    console.log("tags zijn:" + tags);
    //Convert string from input field to array separated by commas
    tags = tags.split(",");
  }
}

function addTag(e) {
  e.preventDefault();
  //checks if the error key is pressed
  let code = e.keycode ? e.keycode : e.which;
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
if (document.querySelector(".tags-input")) {
  document.querySelector(".tags-input").addEventListener("keyup", addTag);
}

let comment = document.querySelector(".comment-icon");
let modal2 = document.getElementById("modal2");
let xy = document.querySelector(".modal-close2");
comment.addEventListener("click", function () {
    modal2.classList.toggle("display");
});

xy.addEventListener("click", function () {
    modal2.classList.remove("display");
});

//AJAX FOR REGISTER.PHP

function checkUsername(e) {
  let username = e.value;
  let usernameLabel = document.querySelector(".username-label");
  let usernameInput = document.querySelector("#ajax-username");

  let data = new FormData();
  data.append("username", username);

  // console.log(username);
  // for (var value of data.values()) {
  //     console.log(value);
  // }

  fetch("./ajax/check_username.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.json())
    .then((data) => {
      if (
        data.status === "success" &&
        data.message === "Username is already used"
      ) {
        usernameLabel.innerHTML = "Username is already used";
        usernameLabel.classList.toggle("form-label-error");
        usernameInput.classList.toggle("form-input-error");
      } else {
        usernameLabel.innerHTML = "Username";
        usernameLabel.classList.remove("form-label-error");
        usernameInput.classList.remove("form-input-error");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function checkEmail(e) {
  let email = e.value;
  let emailLabel = document.querySelector(".email-label");
  let emailInput = document.querySelector("#ajax-email");

  let data = new FormData();
  data.append("email", email);

  fetch("./ajax/check_email.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.json())
    .then((data) => {
      if (
        data.status === "success" &&
        data.message === "Email is already used"
      ) {
        emailLabel.innerHTML = "Email is already used";
        emailLabel.classList.toggle("form-label-error");
        emailInput.classList.toggle("form-input-error");
      } else {
        emailLabel.innerHTML = "Email";
        emailLabel.classList.remove("form-label-error");
        emailInput.classList.remove("form-input-error");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function deletePost(postId) {
  Swal.fire({
    title: "Are you sure you want to delete this post?",
    text: "You won't be able to revert this!",
    color: "#000000",
    icon: "warning",
    iconColor: "#0600ff",
    showCancelButton: true,
    confirmButtonColor: "#F04C25",
    cancelButtonColor: "#CDCEC9",
    confirmButtonText: "Yes, delete it!",
    width: "92%",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = `delete_post.php?postId=${postId}`;
    }
  });
}

function changeFollowState(e, id, userId) {
  followBtn = document.querySelector(".follow-button");

  let ownId = id;
  let watchingId = userId;

  let data = new FormData();
  data.append("id", ownId);
  data.append("userId", watchingId);

  fetch("./ajax/follow_user.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.json())
    .then((data) => {
      if (
        data.status === "success" &&
        data.message === "User has been followed"
      ) {
        followBtn.innerHTML = "Unfollow";
      } else {
        followBtn.innerHTML = "Follow";
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function changeShowcaseState(postId) {

  showcaseIcon = document.getElementById(`project-picture-${postId}`);
  let clickedId = postId;
  let showcaseState = "";

  if (showcaseIcon.classList.contains("showcase-icon-active")) {
    showcaseState = "1"
  } else {
    showcaseState = "0"
  }

  // console.log(clickedId);
  // console.log(showcaseState);

  let data = new FormData();
  data.append("postId", clickedId);
  data.append("state", showcaseState);

  fetch("./ajax/showcase_post.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      if (
        data.status === "success" &&
        data.message === "Post has been added to showcase"
      ) {
        console.log('Added!');
        showcaseIcon.classList.toggle("showcase-icon-active");
      } else {
        console.log('Deleted!');
        showcaseIcon.classList.remove("showcase-icon-active");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// AJAX REPORT
function postReporting(e, id, action) {
  let report = document.getElementById("post-report");
  let unreport = document.getElementById("post-unreport");

  let toShow;

  if (action == "report") {
    toShow = () => {
      report.classList.add("hidden");
      unreport.classList.remove("hidden");
    };
  } else if (action == "unreport") {
    toShow = () => {
      report.classList.remove("hidden");
      unreport.classList.add("hidden");
    };
  } else {
    return;
  }

  let postId = id;

  let data = new FormData();
  data.append("postId", postId);
  data.append("action", action);

  fetch("./ajax/reporting_post.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        toShow();
      } else {
        alert(data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
