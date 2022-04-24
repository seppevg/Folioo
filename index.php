<?php 

include_once("bootstrap.php");

Security::onlyLoggedInUsers();

if (empty($_SESSION['email'])) {
    $email = "";
} else {
    $email = $_SESSION['email'];
}

$pageCounter = 1;
if (!empty($_GET['page'])) {
    $pageCounter = $_GET['page'];
    $pageCounter += 1;
}

if ($pageCounter !== 1) {
    $buttonStyling = 'style="margin-left: 2em"';
} else {
    $buttonStyling = "";
}


$loadedPosts = ($pageCounter - 1)*10;
$posts = Post::getAll($loadedPosts);

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
        <div id="container-logo">
            <img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo">
        </div>

        <?php if (empty($posts)): ?>
            <div id="no-uploads">
                <img src="./assets/no-uploads.svg" alt="No uploads yet">
            </div>
            <div class="main-margin flex">
                <a class="main-btn" href="index.php?page=<?php echo $pageCounter-2; ?>" style="margin-top: 72vh">Previous page</a>
            </div>
        <?php else: ?>
            <div class="allPosts">
                <?php foreach($posts as $post): ?>
                    <?php $profile = Post::getUser($post['user_id']); ?>
                    <article>
                    <a href="post_detail.php?id=<?php echo $post['id'];?>" class="project">
                        <img class="project-picture" src="./uploads/posts/<?php echo $post['image']; ?>" alt="project image">
                    </a>
                        <div class="project-info">
                            <?php if (!empty($email)): ?>
                                <a class="project-author" href="profile.php?id=<?php echo $post['user_id']?>">
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
            <div class="main-margin flex">
                <?php if ($pageCounter !== 1): ?>
                    <a class="main-btn" href="index.php?page=<?php echo $pageCounter-2; ?>" style="margin-right: 2em;">Previous page</a>
                <?php endif; ?>
                <a class="main-btn" href="index.php?page=<?php echo $pageCounter; ?>" <?php echo $buttonStyling; ?> >Next page</a>
            </div>
            <br><br><br><br><br><br><br><br>
        <?php endif; ?>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>

    </div>
    
</body>

</html>