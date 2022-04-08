<?php 

    include_once("bootstrap.php");
    include_once("./includes/upload.inc.php");

    $email = $_SESSION['email'];
    $profile = User::getProfileInfo($email);

    if( isset($_POST['delete-user'])){
        try {        
            // create a new user
            $user = new User();
            if (!empty($_POST['image'])) {
                $user->setImage($_POST['image']);
                $user->setEmail($email);

            }
            session_destroy();
            header("Location: register.php");
            
        }
        catch(Throwable $error) {
            // if any errors are thrown in the class, they can be caught here
            $error = $error->getMessage();
        }
        User::deleteProfile($email);

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
    
        <div class="profile-header">
            <h3 class="profile-username">Delete profile</h3>
            <img src="./assets/settings.svg" alt="Settings">
        </div>
        <?php if(isset($error)): ?>
            <div>
                <p class="error"> <?php echo $error; ?></p>
            </div>
        <?php endif; ?>
        <?php foreach($profile as $p): ?>
            <div class="profile-img profile-img-edit">                
                <div class="profile-img">                    
                    <img src="./uploads/<?php echo $p['image']; ?>">
                    <h3 class="clickable-text"><?php echo $p['username']; ?></h3>
                </div>
            </div>

        <?php endforeach; ?>

        <form action="" method="POST">
            <div class="profile-delete-confirmation">
                <h4>Are you sure you want to delete your profile?</h4>
                <p>By deleting your profile you will be deleting all your posts, comments and likes.
                    You won't be able to get your profile back once it's been deleted.
                </p>
            </div>

            <div class="profile-delete-no">
                <a href="profile.php" class="main-btn">No, I don't want to delete my profile</a>
            </div>

            <div class="profile-delete-yes">
                <button class="main-btn" type="submit" name="delete-user">Yes, I want to delete my profile</button>
            </div>
        </form>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
</body>
</html>