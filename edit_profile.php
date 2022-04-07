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
        <div class="profile-header">
            <h3 class="profile-username">Edit profile</h3>
            <img src="./assets/settings.svg" alt="Settings">
        </div>
        
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <?php foreach($profile as $p): ?>
                <div>
                    <div class="profile-img profile-img-edit">
                        <img style="cursor:pointer" id="profile-display" src="./uploads/<?php echo $p['image']; ?>" onclick="triggerClick()">
                    </div>
                    <label class="clickable-text" style="cursor:pointer" for="image" onclick="triggerClick()">Change profile picture</label>
                    <input type="file" id="profile-picture" name="image" style="display: none;" onchange="displayImage(this)">
                </div>
                <div class="form-container form-container-edit-profile">
                    <div class="form-group">
                        <label class="form-label" for="secondary-email">Secondary email</label>
                        <input name="secondary-email" autofocus="" autocomplete="off" class="form-input" type="email" placeholder="Secondary email">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="education">Education</label>
                        <input name="education" autocomplete="off" class="form-input" type="text" placeholder="Education">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="bio">Bio</label>
                        <input name="bio" autocomplete="off" class="form-input" type="text" placeholder="Bio">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="social-links">Social Links</label>
                        <input name="social-links" autocomplete="off" class="form-input form-input-closer" type="text" placeholder="Facebook">
                        <input name="social-links" autocomplete="off" class="form-input form-input-closer" type="text" placeholder="Instagram">
                        <input name="social-links" autocomplete="off" class="form-input" type="text" placeholder="Behance">
                    </div>
                    <button class="main-btn" type="submit" name="save-user">Update profile</button>
                </div>         
            <?php endforeach; ?>
        </form>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
        
    <script src="./js/app.js"></script>

</body>
</html>