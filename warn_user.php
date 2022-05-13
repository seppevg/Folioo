<?php
include_once("bootstrap.php");

if (empty($_GET['id'])) {
    $userId = "";
} else {
    $userId = $_GET['id'];
}

$profile = User::getInfo($userId);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <title>Folioo - Warn User</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>
<body>
    <div id="profile">
    
        <div class="profile-header">
            <h3 class="profile-username">Warn User</h3>
        </div>
        <?php foreach($profile as $p): ?>
            <div class="profile-img profile-img-edit">                
                <div class="profile-img">                    
                    <img src="./uploads/profiles/<?php echo $p['image']; ?>">
                    <h3 class="clickable-text"><?php echo $p['username']; ?></h3>
                </div>
            </div>

            <form action="" method="post">
                <div class="profile-delete-confirmation">
                    <h4>Reason for warning this user?</h4>
                    <p>Gives us your reason for warning this user so we can let them know what to 
                        change about their behaviour.
                    </p>
                    
                    <div class="form-field">
                        <div class="flex">                            
                            <textarea name="warning-reason" cols="20" rows="5" class="form-input"></textarea>
                        </div>
                    </div>
                    <div>
                        <?php if (isset($error)) : ?>
                            <div>
                                <p class="error"> <?php echo $error ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="profile-delete">
                            <button class="main-btn" type="submit" name="warn-user">Send warning</button>
                        </div>
                    </div>
                </div>
                

            </form>
        <?php endforeach; ?>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
</body>
</html>