<?php 

include_once("bootstrap.php");

Security::onlyLoggedInUsers();

$email = $_SESSION['email'];
$profile = User::getProfileInfo($email);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/style.css">
    <link rel="stylesheet" href="./styling/normalize.css">
    <title>Folioo - Profile</title>
</head>
<body>
    <div id="profile">
        <?php foreach($profile as $p): ?>
            <div class="profile-header">
                <h3 class="profile-username"><?php echo $p['username']; ?></h3>
                <img class="modal-button" src="./assets/burger-menu.svg" alt="Burger menu">
            </div>
            <div class="profile-info">
                <div class="profile-img">
                    <img src="./uploads/<?php echo $p['image']; ?>">
                </div>
                <div class="profile-info-extra">
                    <p class="profile-text"><?php echo $p['education']; ?></p>
                </div>
            </div>
            <div class="profile-bio">
                <p class="profile-text"><?php echo $p['bio']; ?></p>
            </div>
        <?php endforeach; ?>
        
        <div class="profile-edit">
            <a href="edit_profile.php" class="main-btn">Edit profile</a>
        </div>

        <div id="no-uploads">
            <img src="./assets/no-posts.svg" alt="No posts yet">
        </div>

        <section class="modal modal-container ">
            <div id="modal" class="modal-content hidden">
                <div class="modal-close">
                    <img class="modal-icon" src="./assets/close.svg" alt="close">
                </div>
                <a href="reset_password.php">
                    <img class="modal-icon" src="./assets/lock.svg" alt="lock">
                    <p>Reset password</p>
                </a>
                <a href="logout.php">
                    <img class="modal-icon" src="./assets/log-out.svg" alt="log out">
                    <p>Log out</p>
                </a>
                <a href="delete_profile.php">
                    <img class="modal-icon" src="./assets/delete.svg" alt="delete">
                    <p>Delete your profile</p>
                </a>
            </div>

        </section>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
    <script src="./js/app.js"></script>
</body>
</html>