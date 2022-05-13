<!DOCTYPE html>
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
            <img class="modal-button" src="./assets/burger-menu.svg" alt="Burger menu">
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
                    <h4>Wait a minute!</h4>
                    <p>We need to make sure that you're the owner of the account before we 
                        delete it. Please enter your password.
                    </p>
                    
                    <div class="form-field">
                        <div>
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="flex">
                            <input name="current-password" autocomplete="off" class="form-input" type="password" placeholder="Enter password">
                        </div>
                    </div>
                    <div>
                        <?php if (isset($error)) : ?>
                            <div>
                                <p class="error"> <?php echo $error ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="profile-delete">
                            <button class="main-btn" type="submit" name="delete-user">Confirm</button>
                        </div>
                    </div>
                </div>
                

            </form>
        <?php endforeach; ?>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
</body>
</html>