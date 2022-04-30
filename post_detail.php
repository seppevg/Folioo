<?php


include_once("bootstrap.php");

Security::onlyLoggedInUsers();

if (empty($_GET['id'])) {
    header("Location: index.php");
}

$id = $_GET['id'];
$posts = Post::getById($id);

if (sizeof($posts) != 1) {
    header("Location: index.php");
}

$post = $posts[0];

if (empty($post["id"] || empty($post["user_id"]))) {
    header("Location: index.php");
}

$user = User::getInfo($post["user_id"])[0];
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
        <div class="header-content">
            <a class="project-author" href="profile.php?id=<?php echo $post['user_id'] ?>">
                <img src="./uploads/profiles/<?php echo $user['image'] ?>" class="post-profile" alt="Profile picture">
                <h3 class="post-username"><?php echo $user['username']; ?></h3>
            </a>
        </div>
        <img class="modal-button" src="./assets/dots-menu.svg" alt="Dots menu">
    </div>
    <div class="main-margin">
        <div>
            <h3><?php echo $post['title']; ?></h3>
        </div>
        <div class="post-image">
            <img class="project-picture" src="./uploads/posts/<?php echo $post['image']; ?>" alt="Post image">
        </div>
        <!-- <div>
            likes en comment icoontjes
        </div> -->
        <div>
            <h4 class="post-text"><?php echo $post['text']; ?></h4>
        </div>
        <div class="tag-list">
            <?php
            $tagsString = $post['tags'];
            $tags = explode(",", $tagsString);
            foreach ($tags as $tag) :
            ?>
                <div class="tag-item">
                    <a style="text-decoration: none; color: var(--IMDBlue);" href="#">#<?php echo $tag ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <section class="modal modal-container ">
        <div id="modal" class="modal-content hidden">
            <div class="modal-close">
                <img class="modal-icon" src="./assets/close.svg" alt="close">
            </div>
            <a href="edit_post.php?id=<?php echo $post["id"] ?>">
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