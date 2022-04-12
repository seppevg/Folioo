<?php 

include_once("bootstrap.php");

Security::onlyLoggedInUsers();

if (empty($_SESSION['email'])) {
    $email = "";
} else {
    $email = $_SESSION['email'];
}

$posts = Post::getPosts(0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <title>Folioo</title>
</head>

<body>
    <div id="home">
        <div>
            <img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo">
        </div>

        <?php if (empty($posts)): ?>
            <div id="no-uploads">
                <img src="./assets/no-uploads.svg" alt="No uploads yet">
            </div>
        <?php else: ?>
            <div class="allPosts">
                <?php foreach($posts as $post): ?>
                    <?php $profile = Post::getUserOfPost($post['user_id']); ?>
                    <article class="project">
                        <img class="project-picture" src="./assets/no-uploads.svg" alt="project image">
                        <div class="project-info">
                            <?php if (!empty($email)): ?>
                                <a class="project-author" href="#">
                                        <img class="project-author-picture" src="./uploads/<?php echo $profile['image']; ?>" alt="profile picture">
                                        <h4 class="project-author-username"><?php echo $profile['username']; ?></h4>
                                </a>
                                <div class="project-interactions">
                                    <div class="project-interactions-like">
                                        <img class="like-icon" src="./assets/heart-empty.svg" alt="heart or like icon">
                                        <h4>number</h4>
                                    </div>
                                    <div class="project-interactions-comment">
                                        <img class="comment-icon" src="./assets/comment.svg" alt="comment icon">
                                        <h4>number</h4>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php if (!empty($email)): ?>
                <form action="" method="post" class="form">
                    <input style="display:none" type="text" name="loadMore">
                    <div class="flex">
                        <input id="loadMoreProjectsButton" class="main-btn" type="submit" value="Load more">
                    </div>
                </form>
                <br><br><br><br><br><br><br><br>
            <?php else: ?>
                <div class="profile-edit">
                    <a href="welcome.php" class="main-btn">Log in to see more!</a>
                </div>
                <br><br><br><br><br><br><br><br>
            <?php endif; ?>

        <?php endif; ?>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>

    </div>
    
    <script src="./js/app.js"></script>

</body>

</html>