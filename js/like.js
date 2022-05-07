function postLiked(e, postId, userId) {
    console.log("👍");
  
    let postLiked = document.querySelector(`.like-icon-${postId}`);
    let postLikedNumber = document.querySelector(`.numberOfLikes-${postId}`);
    console.log(postLikedNumber);

    let post = postId;
    let user = userId;
  
    let data = new FormData();
    data.append("postId", post);
    data.append("userId", user);
  
    
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
            //postLiked;
            postLikedNumber.innerHTML ++;
            postLiked.src = "./assets/heart-full.svg";
          } else {
            postLikedNumber.innerHTML --;
            postLiked.src = "./assets/heart-empty.svg";
          }
          console.log("Success:", data);
        })
        .catch(error => {
        console.error("Error:", error);
    });
  
  
}
