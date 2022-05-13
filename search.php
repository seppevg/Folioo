<?php session_start();

include_once("bootstrap.php");

if (empty($_SESSION['id'])) {
    $id = "";
} else {
    $id = $_SESSION['id'];
}

if (!empty($_POST)) {
    try {
        $searchResult = $_POST['searchInput'];
        //var_dump ($searchResult);
        $posts = Post::search($searchResult);

        if (empty($_POST['column'])) {
            $filterType = "";
        } else {
            $filterType = $_POST['column'];
        }
        //echo $filterType;

        if ($filterType == "Title") {
            $posts = Post::search($searchResult);
        } elseif ($filterType == "Tags") {
            $posts = Post::searchTags($searchResult);
        }
    } catch (Throwable $error) {
        // if any errors are thrown in the class, they can be caught here
        $error = $error->getMessage();
    }
}

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <title>Folioo - Search</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>

<body>

    <form class="search" method="post">
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
                    <input type="radio" value="Title" name="column" checked="checked"> Title <br> <br>
                    <input type="radio" value="Tags" name="column"> Tags                    
                </form> 
            </div>
        </section>

    </form>
    
    <?php if (empty($posts)):?>
        <div id="no-uploads">
                <img src="./assets/search_empty_state.svg" alt="No uploads yet">
            </div>
    <?php else:?>

    <div class="allPostsSearch">
        <?php foreach ($posts as $post): ?>
            <?php
                $profile = Post::getUser($post['user_id']);
                $commentsCount = Comment::countComments($post['id']);
                $likes = Like::getLikes($post['id']);
                $checkLikes = Like::liked($post['id'], $id);?>
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
                        </div>
                    <?php endif; ?>

                    <?php if (empty($id)): ?>
                        <div class="project-interactions">
                            <div class="project-interactions-like">                    
                                <img id="like-icon" class="like-icon" src="./assets/heart-empty.svg" alt="heart or like icon">
                                <h4 class="numberOfLikes"><?php echo $likes?></h4>
                            </div>
                            <div class="project-interactions-comment">
                                <img class="comment-icon" src="./assets/comment.svg" alt="comment icon">
                                <h4><?php echo $commentsCount?></h4>
                            </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (isset($error)):?>
        <div class="main-margin">
            <p class="error"><?php echo $error ?></p>
        </div>
    <?php endif;?>



    <?php include_once("./includes/nav-bottom.inc.php"); ?>

    <script src="./js/filter.js"></script>
    <script src="./js/like.js"></script>

</body>

</html>