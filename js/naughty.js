function archivePost(e) {
  const postId = e.getAttribute("data-post-id");
  console.log(postId);

  let data = new FormData();
  data.append("post_id", postId);

  fetch("./ajax/archive_post.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      // success
      if (data.status === "success") {
        document.getElementById(`naughty_post_${postId}`).remove();
      }

      // error
      else {
        alert("Something went wrong reporting");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function archiveUser(e) {
    const userId = e.getAttribute("data-user-id");
    console.log(userId);

  let data = new FormData();
  data.append("user_id", userId);

  fetch("./ajax/archive_user.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      // success
      if (data.status === "success") {
        document.getElementById(`naughty_user_${userId}`).remove();
      }

      // error
      else {
        alert("Something went wrong reporting");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
