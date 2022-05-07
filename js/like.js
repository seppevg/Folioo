document.querySelector(".like").addEventListener("click", function(e){
    //console.log("👍");
  
    let post = e.target.dataset.post; 
    let user = e.target.dataset.user;
  
    e.preventDefault();
  
    let data = new FormData();
    data.append("post", post);
    data.append("user", user);
  
    
    fetch('./ajax/save_like.php', {
        method: 'POST', 
        body: data
    })
        .then(response => response.json())
        .then(data => {
          if(
            data.status === "success" &&
            data.message === "Like was saved"
          ){
            document.querySelector(".numberOfLikes").innerHTML ++;
            document.querySelector("#like-icon").src = "./assets/heart-full.svg";
          } else {
            document.querySelector(".numberOfLikes").innerHTML --;
            document.querySelector("#like-icon").src = "./assets/heart-empty.svg";
          }
          console.log("Success:", data);
        })
        .catch(error => {
        console.error("Error:", error);
    });
  
  });