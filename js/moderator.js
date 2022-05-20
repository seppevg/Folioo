function addModerator(e, userId, moderator) {
  //console.log("👍");

  let moderatorIcon = document.querySelector(".moderator-icon");

  let user = userId;
  let isModerator = moderator;
  //console.log(isModerator);

  let data = new FormData();
  data.append("userId", user);
  data.append("moderator", isModerator);


  fetch('./ajax/save_moderator.php', {
    method: 'POST',
    body: data
  })
    .then(response => response.json())
    .then(data => {
      if (
        data.status === "success" &&
        data.message === "Add moderator role"
      ) {
        moderatorIcon.src = "./assets/moderator-on.svg";
        //console.log("❤");
      } else {
        moderatorIcon.src = "./assets/moderator-off.svg";
      }
      console.log("Success:", data);
    })
    .catch(error => {
      console.error("Error:", error);
    });
}