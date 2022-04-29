<?php

include_once("bootstrap.php");

if (empty($_GET['id'])) {
    $id = "";
} else {
    $id = $_GET['id'];
}

$post = Post::getPostById($id);
$user = User::getInfo($post[0]["user_id"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <title>Folioo - Details</title>
</head>

<body>
    
    <div class="profile-header padding">
        <?php foreach ($post as $p):?>
        <div class="header-content">
            <a class="project-author" href="profile.php?id=<?php echo $p['user_id']?>">
                <img src="./uploads/profiles/<?php echo $user[0]['image']?>" class="post-profile" alt="Profile picture">
                <h3 class="post-username"><?php echo $user[0]['username']; ?></h3>
            </a>
        </div>
        <?php endforeach; ?>
        <img class="modal-button" src="./assets/dots-menu.svg" alt="Dots menu">
    </div>
    <div class="main-margin">
        <div>
            <h3><?php echo $post[0]['title']; ?></h3>
        </div>
        <div class="post-image">
            <img class="project-picture" src="./uploads/posts/<?php echo $post[0]['image']; ?>" alt="Post image">
        </div>
        <!-- <div>
            likes en comment icoontjes
        </div> -->
        <div>
            <h4 class="post-text"><?php echo $post[0]['text'];?></h4>
        </div>
        <div class="post-tags">
            <h4><?php echo $post[0]['tags'];?></h4>
        </div>
    </div>

    <section class="modal modal-container ">
        <div id="modal" class="modal-content hidden">
            <div class="modal-close">
                <img class="modal-icon" src="./assets/close.svg" alt="close">
            </div>
            <a href="edit_post.php?id=<?php echo $post[0]["id"]?>">
                <img class="modal-icon" src="./assets/edit.svg" alt="lock">
                <p>Edit post</p>
            </a>
            <a href="profile.php">
                <img class="modal-icon" src="./assets/delete.svg" alt="log out">
                <p>Delete post</p>
            </a>
        </div>
    </section>
    <?php include_once("./includes/nav-bottom.inc.php"); ?>
    <script src="./js/app.js"></script>
</body>

</html>