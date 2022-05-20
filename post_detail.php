<?php session_start();

include_once("bootstrap.php");

if (empty($_GET['id'])) {
    header("Location: index.php");
}

$id = $_GET['id'];
$posts = Post::getById($id);


if (sizeof($posts) != 1) {
    header("Location: index.php");
}

$post = $posts[0];
//var_dump($post);


if (empty($post["id"] || empty($post["user_id"]))) {
    header("Location: index.php");
}

$user = User::getInfo($post["user_id"])[0];


//checking if the post is from the person that's logged in
if (empty($_SESSION['id'])) {
    $sessionId = "";
} else {
    $sessionId = $_SESSION['id'];
}

$userId = Post::getById($_GET['id'])[0];

$idUser = $userId["user_id"];


$commentsCount = Comment::countComments($post['id']);

$likes = Like::getLikes($post['id']);
$checkLikes = Like::liked($post['id'], $sessionId);

//reporting
if (!empty($_POST)) {
    try {
        $comment = new Comment();
        $comment->setComment($_POST['comment']);
        $comment->setUserId($sessionId);
        $comment->setPostId($id);
        $comment->Save();
    } catch (Throwable $error) {
        // if any errors are thrown in the class, they can be caught here
        $error = $error->getMessage();
    }
}

$comments = Comment::getAll($id);

//checks if the logged in user already reported that post
$reported = ReportPost::checkIfReportedByUser($sessionId, $post["id"]);
$isAlreadyReported = $reported > 0;

$isBanned = User::isBanned($idUser);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <link rel="stylesheet" href="./styling/desktop.css">
    <title>Folioo - Details</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>

<body id="post-details">
    <?php include_once("./includes/nav-top.inc.php"); ?>
    <div class="profile-header profile-header-pd padding">
        <div class="header-content">
            <a class="project-author" href="profile.php?id=<?php echo $post['user_id'] ?>">
                <img src="./uploads/profiles/<?php echo $user['image'] ?>" class="post-profile" alt="Profile picture">
                <h3 class="post-username"><?php echo htmlspecialchars($user['username']); ?></h3>
            </a>
        </div>    
        <?php if ($userId["user_id"] == $sessionId) :?>
            <img class="modal-button" id="modal_btn_pdown" src="./assets/dots-menu.svg" alt="Dots menu">
        <?php else: ?>
            <img class="modal-button" id="modal_btn_pd" src="./assets/dots-menu.svg" alt="Dots menu">
        <?php endif; ?>  
    </div>

    <div class="main-margin">
        <div>
            <div>
                <h3 class="hide-on-desktop"><?php echo htmlspecialchars($post['title']); ?></h3>
            </div>
            <div class="post-image">
                <img class="project-picture" src="./uploads/posts/<?php echo $post['image']; ?>" alt="Post image">
            </div>
        </div>
        <div class="profile-sidebar-container">
            <div class="profile-sidebar">
                <div class="profile-header hide-on-mobile">
                    <div class="header-content">
                        <a class="project-author" href="profile.php?id=<?php echo $post['user_id'] ?>">
                            <img src="./uploads/profiles/<?php echo $user['image'] ?>" class="post-profile" alt="Profile picture">
                            <h3 class="post-username"><?php echo htmlspecialchars($user['username']); ?></h3>
                        </a>
                    </div>    
                    <?php if ($userId["user_id"] == $sessionId) :?>
                        <img class="modal-button" id="modal_btn_report_post1" src="./assets/dots-menu.svg" alt="Dots menu">
                    <?php else: ?>
                        <img class="modal-button" id="modal_btn_report_post2" src="./assets/dots-menu.svg" alt="Dots menu">
                    <?php endif; ?>  
                </div>
                <div>
                    <h3 class="hide-on-mobile project-title-desktop"><?php echo htmlspecialchars($post['title']); ?></h3>
                </div>
                <div class="profile-sidebar-info">
                    <?php if(!empty($sessionId) && !$isBanned): ?>
                        <form action="" method="post" name="like">
                            <div class="project-interactions">
                                <div class="project-interactions-like" onclick="postLiked(this, <?php echo $post['id'];?>, <?php echo $sessionId?>);">
                                    <a href="#" class="like"> 
                                        <?php if ($checkLikes == "0"): ?>               
                                            <img data-post="<?php echo $post['id']?>" data-user="<?php echo $sessionId; ?>" id="like-icon" class="like-icon-<?php echo $post['id']; ?>" src="./assets/heart-empty.svg" alt="heart or like icon">
                                            <h4 class="numberOfLikes-<?php echo $post['id']; ?>"><?php echo $likes; ?></h4>
                                        <?php elseif ($checkLikes == "1"): ?> 
                                            <img data-post="<?php echo $post['id']?>" data-user="<?php echo $sessionId; ?>" id="like-icon" class="like-icon-<?php echo $post['id']; ?>" src="./assets/heart-full.svg" alt="heart or like icon">
                                            <h4 class="numberOfLikes-<?php echo $post['id']; ?>"><?php echo $likes; ?></h4>
                                        <?php endif; ?>
                                    </a>
                                </div>                 
                                <div class="project-interactions-comment">
                                    <img class="comment-icon" src="./assets/comment.svg" alt="comment icon">
                                    <h4 class="number-of-comments"><?php echo $commentsCount?></h4>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                    <div>
                        <h4 class="post-text"><?php echo htmlspecialchars($post['text']); ?></h4>
                    </div>
                    <?php if ($sessionId) : ?>
                        <div class="tag-list">
                            <?php
                            $tagsString = $post['tags'];
                            $tags = explode(", ", $tagsString);
                            foreach ($tags as $tag) :
                            ?>
                                <div class="tag-item">
                                    <a style="text-decoration: none; color: var(--IMDBlue);" href="index.php?searchInput=<?php echo htmlspecialchars($tag) ?>&filter=Tags">#<?php echo htmlspecialchars($tag) ?></a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="color-list">
                        <?php 
                            $colorPalette = $post['colors'];
                            $palette = explode(", ", $colorPalette);
                            foreach ($palette as $color) : ?>
                            <div class="color-item">
                                <a style="background-color: #<?php echo htmlspecialchars($color) ?>; color: #<?php echo htmlspecialchars($color) ?>;" href="index.php?searchInput=<?php echo htmlspecialchars($color) ?>&filter=Color">oo</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>  
        
            <section class="modal2 modal-container2">
                <div id="modal2" class="modal-content2">
                    <h3 class="profile-username">Comments</h3>
                    <form action="" method="post">
                        <ul id="listupdates">
                            <?php foreach ($comments as $c):?>
                                <?php $profile = Post::getUser($c['user_id']);?>
                                    <div class="comment-box">
                                        <a href="profile.php?id=<?php echo $profile['id']?>">
                                            <img class="project-author-picture-comment" src="./uploads/profiles/<?php echo $profile['image']; ?>" alt="profile picture">
                                            <h4 class="project-author-username-comment"><?php echo htmlspecialchars($profile['username']); ?></h4>
                                        </a>
                                        <p class="posted-comment"><?php echo htmlspecialchars($c['comment']); ?></p>
                                    </div>
                            <?php endforeach;?>
                        </ul>
                        <div class="comment-box">
                            <?php
                                $currentUser = User::getInfo($sessionId);
                                foreach ($currentUser as $cu):
                            ?>
                                <img class="project-author-picture-comment" src="./uploads/profiles/<?php echo $cu['image']; ?>" alt="profile picture">
                                <input type="text" name="comment" id="comment" autocomplete="off" class="form-input" placeholder="Leave a comment!">
                                <a href="#" id="btnAddComment" 
                                    data-postid="<?php echo $userId['id']?>" 
                                    data-username="<?php echo $cu['username']?>"
                                    data-image="<?php echo  $cu['image']?>"
                                    data-number="<?php echo  $commentsCount?>">
                                    <img src="./assets/send.svg" alt="Add icon" class="add-icon">
                                </a>                                        
                            <?php endforeach;?>
                        </div>                
                    </form>
                </div>
                <?php if (isset($error)):?>
                    <div>
                        <p class="error"><?php echo $error ?></p>
                    </div>
                <?php endif; ?>
            </section>   
        </div>
    </div>

    <?php if ($userId["user_id"] == $sessionId) : ?>
        <!-- is it my post? -->
        <!-- edit post modal -->
        <section class="modal modal-container ">
            <div id="modal_pdown" class="modal-content hidden">
                <div class="modal-close" id="modal_close_pdown">
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
        <!-- it's not my post -->
        <!-- report modal -->
        <section class="modal modal-container" id="modal-report">
            <div id="modal_pd" class="modal-content hidden">
                <div class="modal-close" id="modal_close_pd">
                    <img class="modal-icon" src="./assets/close.svg" alt="Close">
                </div>
                <?php $currentUser = User::getInfo($sessionId);?>
                <?php foreach($currentUser as $cu):
                    $moderator = $cu['moderator'];
                ?>  
                <?php endforeach;?>
                <?php if(!empty($moderator)):?>
                    <a href="#" onclick="deletePost(<?php echo $post['id']; ?>)" class="delete-post-popup">
                        <img class="modal-icon" src="./assets/delete.svg" alt="Delete">
                        <p>Delete post</p>
                    </a>
                <?php elseif(empty($moderator)):?>
                    <div id="post-report" <?php echo ($isAlreadyReported) ? 'class="hidden"' : ''; ?>>
                        <h3 class="profile-username">Report this post</h3>
                        <p>Thank you for keeping Folioo a safe space for
                            everyone! This post will be flagged as inappropriate.</p>
                        <div class="center">
                            <img class="report" src="./assets/report.svg" alt="report">
                        </div>
                        <div class="flex">
                            <button class="form-btn" id="report-btn" onclick="postReporting(<?php echo $post['id']; ?>, <?php echo $sessionId; ?>, 'report')">Report</button>
                        </div>
                    </div>
                    <div id="post-unreport" <?php echo ($isAlreadyReported) ? '' : 'class="hidden"'; ?>>
                        <h3 class="profile-username">This post is reported</h3>
                        <p>If you don't think that this post should be flagged as inappropriate then you can unreport this post.
                        </p>
                        <div class="center">
                            <img class="report" src="./assets/report.svg" alt="report">
                        </div>
                        <div class="flex">
                            <button class="form-btn" id="report-btn" onclick="postReporting(<?php echo $post['id']; ?>, <?php echo $sessionId; ?>, 'unreport')">Stop reporting</button>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($userId["user_id"] == $sessionId) : ?>
        <!-- is it my post? -->
        <!-- edit post modal -->
        <section class="modal modal-container modal-container-desktop hidden">
            <div id="modal_report_post1" class="modal-content">
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
        <!-- it's not my post -->
        <!-- report modal -->
        <section class="modal modal-container" id="modal-report">
            <div id="modal_report_post2" class="modal-content hidden">
                <div class="modal-close" id="modal_close_report_post2">
                    <img class="modal-icon" src="./assets/close.svg" alt="Close">
                </div>
                <?php $currentUser = User::getInfo($sessionId);?>
                <?php foreach($currentUser as $cu):
                    $moderator = $cu['moderator'];
                ?>  
                <?php endforeach;?>
                <?php if(!empty($moderator)):?>
                    <a href="#" onclick="deletePost(<?php echo $post['id']; ?>)" class="delete-post-popup">
                        <img class="modal-icon" src="./assets/delete.svg" alt="Delete">
                        <p>Delete post</p>
                    </a>
                <?php elseif(empty($moderator)):?>
                    <div id="post-report" <?php echo ($isAlreadyReported) ? 'class="hidden"' : ''; ?>>
                        <h3 class="profile-username">Report this post</h3>
                        <p>Thank you for keeping Folioo a safe space for
                            everyone! This post will be flagged as inappropriate.</p>
                        <div class="center">
                            <img class="report" src="./assets/report.svg" alt="report">
                        </div>
                        <div class="flex">
                            <button class="form-btn" id="report-btn" onclick="postReporting(<?php echo $post['id']; ?>, <?php echo $sessionId; ?>, 'report')">Report</button>
                        </div>
                    </div>
                    <div id="post-unreport" <?php echo ($isAlreadyReported) ? '' : 'class="hidden"'; ?>>
                        <h3 class="profile-username">This post is reported</h3>
                        <p>If you don't think that this post should be flagged as inappropriate then you can unreport this post.
                        </p>
                        <div class="center">
                            <img class="report" src="./assets/report.svg" alt="report">
                        </div>
                        <div class="flex">
                            <button class="form-btn" id="report-btn" onclick="postReporting(<?php echo $post['id']; ?>, <?php echo $sessionId; ?>, 'unreport')">Stop reporting</button>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </section>
    <?php endif; ?>

    <?php include_once("./includes/nav-bottom.inc.php"); ?>
    <script src="./js/filter.js"></script>
    <script src="./js/dropdown.js"></script>
    <script src="./js/like.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/modal.js"></script>
    <script src="./js/app.js"></script>
</body>

</html>