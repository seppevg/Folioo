<?php 

include_once("bootstrap.php");

Security::onlyLoggedInUsers();

//$email = $_SESSION['email'];
if (empty($_SESSION['id'])) {
    $id = "";
} else {
    $id = $_SESSION['id'];
}

if(empty($_GET['id'])) {
    $userId = "";
} else {
    $userId = $_GET['id'];
    if($userId == $id){
        header("Location: profile.php");
    }
}

$profile = User::getInfo($id);
$userProfiles = User::getInfo($userId);


$posts = Post::getAllFromUser($id);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <title>Folioo - Profile</title>
</head>
<body>
    <div id="profile">
        <?php foreach($profile as $p): ?>
            <?php if(!empty($id)):?>
                <?php if(empty($userId)): ?>
                    <div class="profile-header">
                        <h3 class="profile-username"><?php echo $p['username']; ?></h3>
                        <img class="modal-button" src="./assets/burger-menu.svg" alt="Burger menu">
                    </div>
                    <div class="profile-info">
                        <div class="profile-img">
                            <img src="./uploads/profiles/<?php echo $p['image']; ?>">
                        </div>
                        <div class="profile-info-extra">
                            <p class="profile-text"><?php echo $p['education']; ?></p>
                        </div>
                    </div>
                    <div class="profile-bio">
                        <p class="profile-text"><?php echo $p['bio']; ?></p>
                    </div>

                
                    <div class="profile-edit">
                        <a href="edit_profile.php" class="main-btn">Edit profile</a>
                    </div>

                    <?php if(empty($posts)):?>
                        <div id="no-uploads">
                            <img src="./assets/no-posts.svg" alt="No posts yet">
                        </div>
                    <?php endif;?>

                    <div class="allUserPosts">
                        <?php foreach($posts as $post): ?>
                            <article>
                                <a href="post_detail.php?id=<?php echo $post['id'];?>" class="project">
                                    <img class="project-picture" src="./uploads/posts/<?php echo $post['image']; ?>" alt="project image">
                                </a>
                                <div class="project-info">
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
                                </div>
                            </article>
                        <?php endforeach; ?>
                <?php endif;?>
            <?php endif;?> 
            

            <?php foreach($userProfiles as $up): ?>
                <?php $posts = Post::getAllFromUser($userId);?>
                    <div class="profile-header">
                        <h3 class="profile-username"><?php echo $up['username']; ?></h3>
                        <img class="modal-button" src="./assets/burger-menu.svg" alt="Burger menu">
                    </div>
                    <div class="profile-info">
                        <div class="profile-img">
                            <img src="./uploads/<?php echo $up['image']; ?>">
                        </div>
                        <div class="profile-info-extra">
                            <p class="profile-text"><?php echo $up['education']; ?></p>
                        </div>
                    </div>
                    <div class="profile-bio">
                        <p class="profile-text"><?php echo $up['bio']; ?></p>
                    </div>

                    <?php if(empty($posts)):?>
                        <div id="no-uploads">
                            <img src="./assets/no-posts.svg" alt="No posts yet">
                        </div>
                    <?php endif;?>

                    <div class="allPosts">
                        <?php foreach($posts as $post): ?>
                            <article>
                                <a href="post_detail.php?id=<?php echo $post['id'];?>" class="project">
                                    <img class="project-picture" src="./uploads/posts/<?php echo $post['image']; ?>" alt="project image">
                                </a>
                                <div class="project-info">
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
                                </div>
                            </article>
                        <?php endforeach; ?>
            <?php endforeach;?>
            
            <section class="modal modal-container ">
                <div id="modal" class="modal-content hidden">
                    <div class="modal-close">
                        <img class="modal-icon" src="./assets/close.svg" alt="close">
                    </div>
                    <a href="change_password.php">
                        <img class="modal-icon" src="./assets/lock.svg" alt="lock">
                        <p>Change password</p>
                    </a>
                    <a href="logout.php">
                        <img class="modal-icon" src="./assets/log-out.svg" alt="log out">
                        <p>Log out</p>
                    </a>
                    <a href="#" class="delete-profile-popup">
                        <img class="modal-icon" src="./assets/delete.svg" alt="delete">
                        <p>Delete your profile</p>
                    </a>
                </div>
            </section>
        <?php endforeach; ?>

        <?php if(empty($id)):?>
            <div class="profile-header">
                <h3 class="profile-username">Join the club!</h3>
                <img class="modal-button" src="./assets/burger-menu.svg" alt="Burger menu">
            </div>

            <div class="not-logged-into-profile">
                <h4>You don't have a profile</h4>
                <p>
                    You are currently not logged in to the site, to get proper access create
                    a new user or login with an existing user.
                </p>
            </div>

            <div id="become-friend">
                    <img src="./assets/become-friend.svg" alt="No posts yet">
            </div>

            <div class="main-margin">                    
                    <div class="flex">
                        <a href="login.php" class="form-btn center">Log in</a>
                    </div>

                    <div class="flex">
                        <a href="register.php" class="form-btn center">Register</a>
                    </div>
            </div>

        <?php endif;?>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
    <script src="./js/app.js"></script>
    <script src="./js/delete.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>