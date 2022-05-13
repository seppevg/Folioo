document.querySelector("#warning-btn").addEventListener("click", function(e){
  e.preventDefault();
});

function removeWarning(e, userId) {
  console.log("👍");
  let warningField = document.querySelector("#warning-message-user");

  let user = userId;
  console.log(user);

  let data = new FormData();
  data.append("userId", user);


  fetch('./ajax/confirm_warning.php', {
    method: 'POST',
    body: data
  })
    .then(response => response.json())
    .then(data => {
      if (
        data.status === "success"
      ) {
        
        console.log("❤");
        warningField.innerHTML = "";
        warningField.classList.remove("warning-error");
        
      }
      console.log("Success:", data);
    })
    .catch(error => {
      console.error("Error:", error);
    });
}


