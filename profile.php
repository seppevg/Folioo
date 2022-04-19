<?php 

include_once("bootstrap.php");

Security::onlyLoggedInUsers();

//$email = $_SESSION['email'];
if (empty($_SESSION['email'])) {
    $email = "";
} else {
    $email = $_SESSION['email'];
}

$profile = User::getInfo($email);

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
            <?php if(!empty($email)):?>
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

            
                <div class="profile-edit">
                    <a href="edit_profile.php" class="main-btn">Edit profile</a>
                </div>

                <div id="no-uploads">
                    <img src="./assets/no-posts.svg" alt="No posts yet">
                </div>

            <?php endif;?> 

            <section class="modal modal-container ">
                <div id="modal" class="modal-content hidden">
                    <div class="modal-close">
                        <img class="modal-icon" src="./assets/close.svg" alt="close">
                    </div>
                    <a href="change_password.php?id=<?php echo $p['id']; ?>">
                        <img class="modal-icon" src="./assets/lock.svg" alt="lock">
                        <p>Change password</p>
                    </a>
                    <a href="logout.php">
                        <img class="modal-icon" src="./assets/log-out.svg" alt="log out">
                        <p>Log out</p>
                    </a>
                    <a href="delete_profile.php?id=<?php echo $p['id']; ?>">
                        <img class="modal-icon" src="./assets/delete.svg" alt="delete">
                        <p>Delete your profile</p>
                    </a>
                </div>
            </section>
        <?php endforeach; ?>

        <?php if(empty($email)):?>
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
</body>
</html>