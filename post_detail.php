<?php


include_once("bootstrap.php");

Security::onlyLoggedInUsers();
if (empty($_SESSION['id'])) {
    $currentId = "";
} else {
    $currentId = $_SESSION['id'];
}


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
<<<<<<< HEAD

//checking if the post is from the person that's logged in
if (empty($_SESSION['id'])) {
    $sessionId = "";
} else {
    $sessionId = $_SESSION['id'];
}

$userId = Post::getById($_GET['id'])[0];

//reporting

?>
=======
>>>>>>> f16

if(!empty($_POST)) {
    try{
        
        //var_dump($userName);
        
        $comment = new Comment();
        $comment->setComment($_POST['comment']);
        $comment->setUserId($currentId);
        $comment->setPostId($id);
        $comment->Save();

    }
    catch(Throwable $error) {
        // if any errors are thrown in the class, they can be caught here
        $error = $error->getMessage();
    } 
}


$comments = Comment::getAllCommentsPost($id);
//var_dump($comments);
$userName = Comment::getByUserId($id);
//var_dump($userName);
foreach($userName as $un){
    $profiles = Comment::getUser($un['user_id']);

}
/*for ($i = 0; $i < count($profiles); $i++){
    $profile = $profiles[$i];
    var_dump(count($profiles));
}*/

/*$profile = $profiles[0];
var_dump($profile);*/
//var_dump($profiles);
//$profile = $profiles;
//var_dump($profiles);






//var_dump($userName);

//var_dump($profile);




?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <title>Folioo - Details</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
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


    <?php if ($userId["user_id"] == $sessionId) : ?>
        <!-- edit post modal -->
        <section class="modal modal-container ">
            <div id="modal" class="modal-content hidden">
                <div class="modal-close">
                    <img class="modal-icon" src="./assets/close.svg" alt="Close">
                </div>
                <a href="edit_post.php?id=<?php echo $post["id"] ?>">
                    <img class="modal-icon" src="./assets/edit.svg" alt="Edit">
                    <p>Edit post</p>
                </a>
                <a href="#" onclick="deletePost(<?php echo $post['id']; ?>)" class="delete-post-popup">
                    <img class="modal-icon" src="./assets/delete.svg" alt="Delete">
                    <p>Delete post</p>
                </a>
            </div>
        </section>
    <?php else : ?>
        <!-- report modal -->
        <section class="modal modal-container ">
            <div id="modal" class="modal-content hidden">
                <div class="modal-close">
                    <img class="modal-icon" src="./assets/close.svg" alt="Close">
                </div>
                <div id="post-report">
                    <h3 class="profile-username">Report this post</h3>
                    <p>Thank you for keeping Folioo a safe space for
                        everyone! This post will be flagged as inappropriate.</p>
                    <div class="center">
                        <img class="report" src="./assets/report.svg" alt="report">
                    </div>
                    <div class="flex">
                        <button class="form-btn" onclick="postReporting(this, <?php echo $post['id']; ?>, 'report')">Report</button>
                    </div>
                </div>
                <div id="post-unreport" class="hidden">
                    <h3 class="profile-username">This post is reported</h3>
                    <p>If you don't think that this post should be flagged as inappropriate then you can unreport this post.</p>
                    <div class="center">
                        <img class="report" src="./assets/report.svg" alt="report">
                    </div>
                    <div class="flex">
                        <button class="form-btn" onclick="postReporting(this, <?php echo $post['id']; ?>, 'unreport')">Stop reporting</button>
                    </div>
                </div>

            </div>
        </section>
    <?php endif; ?>

    <section class="modal2 modal-container2">
        <div id="modal2" class="modal-content2 hidden">
            <div class="modal-close2">
                <img class="modal-icon2" src="./assets/close.svg" alt="close">
            </div>

            <form action="" method="post">
                <ul id="listupdates">
                    <?php foreach($comments as $c):?>
                        <?php $profiles = Comment::getUser($un['user_id']);
                        foreach($profiles as $p):?>
                            <img class="project-author-picture" src="./uploads/profiles/<?php echo $p['image']; ?>" alt="profile picture">
                            <h4 class="project-author-username"><?php echo $p['username']; ?></h4>
                        <p><?php echo $c['comment']; ?></p>
                    <?php endforeach;?>
                    <?php endforeach;?>

                </ul>

                <input type="text" name="comment" autocomplete="off" class="form-input" placeholder="Leave a comment!">
            </form>
        </div>
        <?php if(isset($error)):?>
        <div>
            <p class="error"><?php echo $error ?></p>
        </div>
    <?php endif;?>
    </section>

    <?php include_once("./includes/nav-bottom.inc.php"); ?>
    <script src="./js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>