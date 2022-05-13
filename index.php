<?php

include_once("bootstrap.php");

Security::onlyLoggedInUsers();

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

$loadedPosts = ($pageCounter - 1)*20;
$posts = Post::getAll($loadedPosts);

if (empty($_GET['feed'])) {
    $url = "";
} else {
    $url = $_GET['feed'];
}

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
    <nav class="top-nav">
        <div id="container-logo">
            <div class="dropdown">
                <img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo">
                <button class="dropdown-button"><img class="dropdown-icon" src="./assets/dropdown.svg" alt="Dropdown arrow"></button>
                <div class="dropdown-menu">
                    <div>
                        <a href="index.php?feed=chronologic">Chronologic</a>
                        <img src="./assets/chronologic.svg" alt="Chronologic icon">
                    </div>
                    <div>
                        <a href="index.php?feed=following">Following</a>
                        <img src="./assets/following.svg" class="following-icon" alt="Following icon">
                    </div>                    
                </div>
            </div>
        </div>

        <form class="search search-nav" method="post">
            <div class="profile-header">
                <input type="text" name="searchInput" placeholder="Search" class="inputSearch">

                <button class="filterbtn">
                    <img class="modal-button" src="./assets/filter.svg" alt="Filter icon">
                </button>

                <button type="submit" name="submit-search" class="searchbtn">
                    <img src="./assets/search.svg" alt="Search icon">
                </button>
            </div>

            <section class="modal modal-container">
                <div id="modal" class="modal-content hidden">
                    <h3>Choose your filter</h3>
                    <form method="post">
                        <input type="radio" value="Title" name="column"> Title <br> <br>
                        <input type="radio" value="Tags" name="column"> Tags                    
                    </form> 
                </div>
            </section>
        </form>

        <div class="user-links">
            <a class="main-btn add-project-nav" href="add.php">Inspire others</a>
            <a href="profile.php" class="nav-user">
                <img src="./uploads/profiles/1.jpg">
            </a>
            <button class="dropdown-button">
                <img class="dropdown-icon" src="./assets/dropdown.svg" alt="Dropdown arrow">
            </button>
        </div>
    </nav>

    <div id="home">
        <div id="container-logo">
            <div class="dropdown">
                <img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo">
                <?php if (!empty($id)): ?>
                    <button class="dropdown-button"><img class="dropdown-icon" src="./assets/dropdown.svg" alt="Dropdown arrow"></button>
                        <div class="dropdown-menu">
                            <div>
                                <a href="index.php?feed=chronologic">Chronologic</a>
                                <img src="./assets/chronologic.svg" alt="Chronologic icon">
                            </div>
                            <div>
                                <a href="index.php?feed=following">Following</a>
                                <img src="./assets/following.svg" class="following-icon" alt="Following icon">
                            </div>                    
                        </div>
                <?php endif;?>
            </div>
        </div>

        <?php if(!empty($hasWarning)):?>
            <input type='hidden' id='alert' name='alert' value="1">
        <?php elseif(empty($hasWarning)):?>
            <input type='hidden' id='alert' name='alert' value="0">
        <?php endif;?>

        <?php if (empty($posts)): ?>
            <div id="no-uploads">
                <img src="./assets/no-uploads.svg" alt="No uploads yet">
            </div>
            <div class="main-margin flex">
                <a class="main-btn" href="index.php?page=<?php echo $pageCounter-2; ?>" style="margin-top: 72vh">Previous page</a>
            </div>
        <?php else: ?>
            <div class="feed">
            <?php if ($url === "chronologic" || $url === ""):?>
                <?php foreach ($posts as $post): ?>
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
                                    <h4 class="project-author-username"><?php echo htmlspecialchars($profile['username']); ?></h4>
                                </a>
                                <form action="" method="post" name="like">
                                    <div class="project-interactions">
                                        <div class="project-interactions-like" onclick="postLiked(this, <?php echo $post['id'];?>, <?php echo $id?>);">
                                            <a href="#" class="like"> 
                                                <?php if ($checkLikes == "0"):?>               
                                                    <img data-post="<?php echo $post['id']?>" data-user="<?php echo $id?>" id="like-icon" class="like-icon-<?php echo $post['id']; ?>" src="./assets/heart-empty.svg" alt="heart or like icon">
                                                    <h4 class="numberOfLikes-<?php echo $post['id']; ?>"><?php echo $likes?></h4>
                                                <?php elseif ($checkLikes == "1"):?> 
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
                <?php endif;?>

                <?php if ($url === "following"):?>
                    <?php $following = Followers::getAll($id);?>
                        <?php if (empty($following)):?>
                            <div id="no-uploads">
                                <img src="./assets/not_following.svg" alt="Not following anyone yet">
                            </div>
                        <?php endif;?>
                    <?php
                        foreach ($following as $f):
                        $postsUser = Post::getAllFromUser($f['following_id']);
                        foreach ($postsUser as $puser):
                    ?>

                        <?php
                            $profile = Post::getUser($puser['user_id']);
                            $commentsCount = Comment::countComments($puser['id']);
                            $likes = Like::getLikes($puser['id']);
                            $checkLikes = Like::liked($puser['id'], $id);
                        ?>
                        <article>
                        <a href="post_detail.php?id=<?php echo $puser['id'];?>" class="project">
                            <img class="project-picture" src="./uploads/posts/<?php echo $puser['image']; ?>" alt="project image">
                        </a>
                            <div class="project-info">
                                <?php if (!empty($id)): ?>
                                    <a class="project-author" href="profile.php?id=<?php echo $puser['user_id']?>">
                                        <img class="project-author-picture" src="./uploads/profiles/<?php echo $profile['image']; ?>" alt="profile picture">
                                        <h4 class="project-author-username"><?php echo $profile['username']; ?></h4>
                                    </a>
                                    <form action="" method="post" name="like">
                                        <div class="project-interactions">
                                            <div class="project-interactions-like" onclick="postLiked(this, <?php echo $puser['id'];?>, <?php echo $id?>);">
                                                <a href="#" class="like"> 
                                                    <?php if ($checkLikes == "0"):?>               
                                                        <img data-post="<?php echo $puser['id']?>" data-user="<?php echo $id?>" id="like-icon" class="like-icon-<?php echo $puser['id']; ?>" src="./assets/heart-empty.svg" alt="heart or like icon">
                                                        <h4 class="numberOfLikes-<?php echo $puser['id']; ?>"><?php echo $likes?></h4>
                                                    <?php elseif ($checkLikes == "1"):?> 
                                                        <img data-post="<?php echo $puser['id']?>" data-user="<?php echo $id?>" id="like-icon" class="like-icon-<?php echo $puser['id']; ?>" src="./assets/heart-full.svg" alt="heart or like icon">
                                                        <h4 class="numberOfLikes-<?php echo $puser['id']; ?>"><?php echo $likes?></h4>
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
                    <?php endforeach;?>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
            <div class="main-margin flex">
                <?php if ($pageCounter !== 1): ?>
                    <a class="main-btn" href="index.php?page=<?php echo $pageCounter-2; ?>" style="margin-right: 2em;">Previous page</a>
                <?php endif; if (count($posts) > 19): ?>
                    <a class="main-btn" href="index.php?page=<?php echo $pageCounter; ?>" <?php echo $buttonStyling; ?> >Next page</a>
                <?php endif; ?>
            </div>
            <br><br><br>
        <?php endif; ?>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
        <script src="./js/filter.js"></script>
        <script src="./js/like.js"></script>
        <script src="./js/dropdown.js"></script>
        <script src="./js/warning.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
        <script src="./js/masonry.js"></script>

    </div>
    
</body>

</html>