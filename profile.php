<?php 

include_once("bootstrap.php");

Security::onlyLoggedInUsers();

$email = $_SESSION['email'];
$profile = User::getProfileImg($email);

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
                <img src="./assets/settings.svg" alt="Settings">
            </div>
            <div class="profile-img">
                <img src="./uploads/<?php echo $p['image']; ?>">
            </div>
        <?php endforeach; ?>
        
        <div class="profile-edit">
            <a href="edit_profile.php" class="main-btn">Edit profile</a>
        </div>

        <div id="no-uploads">
            <img src="./assets/no-posts.svg" alt="No posts yet">
        </div>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
</body>
</html>