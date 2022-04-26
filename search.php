<?php

include_once("bootstrap.php");

/*$posts = new Post();
$posts->searchPosts();*/

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

/*if(!empty($_POST['submit-search'])) {
    $search = $_POST['searchInput'];
    $searchResult = Post::searchPosts($search);
    var_dump($searchResult);
}*/

if (isset($_GET['searchInput'])) {
    $searchResult = $_GET['searchInput'];
    var_dump($searchResult);
    Post::searchPosts($searchResult);
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
    <title>Folioo - Search</title>
</head>

<body>
    <div id="container-logo">
        <img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo">
    </div>

    <form class="search">
        <input type="text" name="searchInput" placeholder="Search" class="inputSearch">
        <button type="submit" name="submit-search" class="searchbtn">Search</button>
    </form>

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

    <?php include_once("./includes/nav-bottom.inc.php"); ?>
</body>

</html>