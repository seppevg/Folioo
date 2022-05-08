<?php 

include_once("bootstrap.php");

Security::onlyLoggedInUsers();

/*$id = $_SESSION['id'];
var_dump($id);*/

if (empty($_SESSION['id'])) {
    $id = "";
} else {
    $id = $_SESSION['id'];
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
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>

<body>
    <div id="home">
        <div id="container-logo">
            <img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo">
            <img class="dropdown-icon" src="./assets/dropdown.svg" alt="Dropdown arrow">
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
                    <?php   
                        $profile = Post::getUser($post['user_id']); 
                        $commentsCount = Comment::countComments($post['id']);
                        $likes = Like::getLikes($post['id']);
                        $checkLikes = Like::liked($post['id'], $id);
                    ?>
                    <article>
                    <a href="post_detail.php?id=<?php echo $post['id'];?>" class="project">
                        <img class="project-picture" src="./uploads/posts/<?php echo $post['image']; ?>" alt="project image">
                    </a>
                        <div class="project-info">
                            <?php if (!empty($id)): ?>
                                <a class="project-author" href="profile.php?id=<?php echo $post['user_id']?>">
                                    <img class="project-author-picture" src="./uploads/profiles/<?php echo $profile['image']; ?>" alt="profile picture">
                                    <h4 class="project-author-username"><?php echo $profile['username']; ?></h4>
                                </a>
                                <form action="" method="post" name="like">
                                    <div class="project-interactions">
                                        <div class="project-interactions-like" onclick="postLiked(this, <?php echo $post['id'];?>, <?php echo $id?>);">
                                            <a href="#" class="like"> 
                                                <?php if($checkLikes == "0"):?>               
                                                    <img data-post="<?php echo $post['id']?>" data-user="<?php echo $id?>" id="like-icon" class="like-icon-<?php echo $post['id']; ?>" src="./assets/heart-empty.svg" alt="heart or like icon">
                                                    <h4 class="numberOfLikes-<?php echo $post['id']; ?>"><?php echo $likes?></h4>
                                                <?php elseif($checkLikes == "1"):?> 
                                                    <img data-post="<?php echo $post['id']?>" data-user="<?php echo $id?>" id="like-icon" class="like-icon-<?php echo $post['id']; ?>" src="./assets/heart-full.svg" alt="heart or like icon">
                                                    <h4 class="numberOfLikes-<?php echo $post['id']; ?>"><?php echo $likes?></h4>
                                                <?php endif;?>
                                            </a>
                                        </div>
                                        <div class="project-interactions-comment">
                                            <img class="comment-icon" src="./assets/comment.svg" alt="comment icon">
                                            <h4><?php echo $commentsCount?></h4>
                                        </div>
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="main-margin flex">
                <?php if ($pageCounter !== 1): ?>
                    <a class="main-btn" href="index.php?page=<?php echo $pageCounter-2; ?>" style="margin-right: 2em;">Previous page</a>
                <?php endif; if (count($posts) > 9): ?>
                    <a class="main-btn" href="index.php?page=<?php echo $pageCounter; ?>" <?php echo $buttonStyling; ?> >Next page</a>
                <?php endif; ?>
            </div>
            <br><br><br><br><br><br><br><br>
        <?php endif; ?>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
        <script src="./js/like.js"></script>



    </div>
    
</body>

</html>