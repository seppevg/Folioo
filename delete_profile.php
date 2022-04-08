<?php 

    include_once("bootstrap.php");
    include_once("./includes/upload.inc.php");

    $email = $_SESSION['email'];
    $profile = User::getProfileInfo($email);

    if( !empty($_POST) ){
        try {        
            // create a new user
            $user = new User();
            if (!empty($_POST['image'])) {
                $user->setImage($_POST['image']);
            }
            $user->setSecondaryEmail($_POST['secondary-email']);
            $user->setEducation($_POST['education']);
            $user->setBio($_POST['bio']);
            $user->setInstagramLink($_POST['instagram-link']);
            $user->setBehanceLink($_POST['behance-link']);
            $user->setLinkedinLink($_POST['linkedin-link']);
            $user->setEmail($email);

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
    <link rel="stylesheet" href="./styling/style.css">
    <link rel="stylesheet" href="./styling/normalize.css">
    <title>Folioo - Profile</title>
</head>
<body>
    <div id="profile">
        <?php foreach($profile as $p): ?>
            <div class="profile-header">
                <h3 class="profile-username">Delete profile</h3>
                <img src="./assets/settings.svg" alt="Settings">
            </div>
            <div class="profile-img profile-img-edit">
                
                <div class="profile-img">
                    <h3 class="profile-username"><?php echo $p['username']; ?></h3>
                    <img src="./uploads/<?php echo $p['image']; ?>">
                </div>
            </div>

        <?php endforeach; ?>
        <h4>Are you sure you want to delete your profile?</h4>
        <p>By deleting your profile you will be deleting all your posts, comments and likes.</p>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
</body>
</html>