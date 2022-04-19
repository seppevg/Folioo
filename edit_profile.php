<?php 

    include_once("bootstrap.php");
    include_once("./includes/upload.inc.php");

    $email = $_SESSION['email'];
    $profile = User::getInfo($email);

    if( !empty($_POST) ){
        try {        
            // create a new user
            $user = new User();
            $user->setImage($_POST['image']);
            $user->setSecondaryEmail($_POST['secondary-email']);
            $user->setEducation($_POST['education']);
            $user->setBio($_POST['bio']);
            $user->setInstagramLink($_POST['instagram-link']);
            $user->setBehanceLink($_POST['behance-link']);
            $user->setLinkedinLink($_POST['linkedin-link']);
            $user->setEmail($email);
            $user->update();

            header("Location: profile.php");
            
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
    <title>Folioo - Profile</title>
</head>
<body>
    <div id="profile">
        <div class="profile-header">
            <h3 class="profile-username">Edit profile</h3>
            <img src="./assets/burger-menu.svg" alt="Burger menu">
        </div>
        <?php if(isset($error)): ?>
            <div>
                <p class="error"> <?php echo $error; ?></p>
            </div>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
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
                        <?php if (!empty($p['secondary_email'])): ?>
                            <input name="secondary-email" autofocus="" autocomplete="off" class="form-input" type="email" placeholder="Secondary email" value="<?php echo $p['secondary_email']; ?>">
                        <?php else: ?>
                            <input name="secondary-email" autofocus="" autocomplete="off" class="form-input" type="email" placeholder="Secondary email">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="education">Education</label>
                        <?php if (!empty($p['education'])): ?>
                            <input name="education" autocomplete="off" class="form-input" type="text" placeholder="Education" value="<?php echo $p['education']; ?>">
                        <?php else: ?>
                            <input name="education" autocomplete="off" class="form-input" type="text" placeholder="Education">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="bio">Bio</label>
                        <?php if (!empty($p['bio'])): ?>
                            <textarea style="resize: none;" rows="3" name="bio" autocomplete="off" class="form-input" type="text" placeholder="Bio"><?php echo $p['bio']; ?></textarea>
                        <?php else: ?>
                            <textarea style="resize: none;" rows="3" name="bio" autocomplete="off" class="form-input" type="text" placeholder="Bio"></textarea>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="instagram-link">Social Links</label>
                        <?php if (!empty($p['instagramlink'])): ?>
                            <input name="instagram-link" autocomplete="off" class="form-input form-input-closer" type="text" placeholder="Instagram" value="<?php echo $p['instagramlink']; ?>">
                        <?php else: ?>
                            <input name="instagram-link" autocomplete="off" class="form-input form-input-closer" type="text" placeholder="Instagram">
                        <?php endif; ?>
                        <?php if (!empty($p['behancelink'])): ?>
                            <input name="behance-link" autocomplete="off" class="form-input form-input-closer" type="text" placeholder="Behance" value="<?php echo $p['behancelink']; ?>">
                        <?php else: ?>
                            <input name="behance-link" autocomplete="off" class="form-input form-input-closer" type="text" placeholder="Behance">
                        <?php endif; ?>
                        <?php if (!empty($p['linkedinlink'])): ?>
                            <input name="linkedin-link" autocomplete="off" class="form-input" type="text" placeholder="LinkedIn" value="<?php echo $p['linkedinlink']; ?>">
                        <?php else: ?>
                            <input name="linkedin-link" autocomplete="off" class="form-input" type="text" placeholder="LinkedIn">
                        <?php endif; ?>
                    </div>
                    <button class="main-btn" type="submit" name="save-user">Update profile</button>
                </div>         
            <?php endforeach; ?>
        </form>
        <br><br><br><br><br><br><br><br>
        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
        
    <script src="./js/app.js"></script>

</body>
</html>