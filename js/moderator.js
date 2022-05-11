function addModerator(e, userId) {
    console.log("👍");
  
    let user = userId;

    let data = new FormData();
    data.append("userId", user);
  
    
    fetch('./ajax/save_moderator.php', {
        method: 'POST', 
        body: data
    })
        .then(response => response.json())
        .then(data => {
          if(
            data.status === "success"
          ){
            //postLiked;
            console.log("❤");
          }
          console.log("Success:", data);
        })
        .catch(error => {
        console.error("Error:", error);
    });
  
  
}