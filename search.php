<?php

include_once("bootstrap.php");


if (empty($_SESSION['id'])) {
    $id = "";
} else {
    $id = $_SESSION['id'];
}

if( !empty($_POST) ){
    try {
        $searchResult = $_POST['searchInput'];
        //var_dump ($searchResult);
        $filterType = $_POST['column'];
        //echo $filterType;

        if($filterType == "") {
            $posts = "";
        }
        elseif ($filterType == "Title"){
            $posts = Post::searchPostsByTitle($searchResult);
        }
        elseif ($filterType == "Tag"){
            $posts = Post::searchPostsByTags($searchResult);
        }
        
    }
    catch(Throwable $error) {
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
</head>

<body>
    <div id="container-logo">
        <img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo">
    </div>

    <form class="search" method="post">
        <input type="text" name="searchInput" placeholder="Search" class="inputSearch">

        <select name="column">
            <option value="All">Select filter</option>
            <option value="Title">Title</option>
            <option value="Tag">Tag</option>
        </select>

        <button type="submit" name="submit-search" class="searchbtn">Search</button>
    </form>
    
    <?php if(empty($posts)):?>
        <div id="no-uploads">
                <img src="./assets/no-uploads.svg" alt="No uploads yet">
            </div>
    <?php else:?>

    <div class="allPostsSearch">
        <?php foreach($posts as $post): ?>
            <?php $profile = Post::getUser($post['user_id']); ?>
            <article>
            <a href="post_detail.php?id=<?php echo $post['id'];?>" class="project">
                <img class="project-picture" src="./uploads/posts/<?php echo $post['image']; ?>" alt="project image">
            </a>
                <div class="project-info">
                    <?php if (empty($id)): ?>
                        <a class="project-author" href="profile.php?id=<?php echo $post['user_id']?>">
                                <img class="project-author-picture" src="./uploads/profiles/<?php echo $profile['image']; ?>" alt="profile picture">
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
    <?php endif; ?>

    <?php if(isset($error)):?>
        <div>
            <p class="error"><?php echo $error ?></p>
        </div>
    <?php endif;?>

    <?php include_once("./includes/nav-bottom.inc.php"); ?>

</body>

</html>