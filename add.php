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
    <title>Folioo - Add</title>
</head>
<body>
    <div id="add">
        <div class="profile-header">
            <h3 class="profile-username">Add project</h3>
            <img class="modal-button" src="./assets/burger-menu.svg" alt="Burger menu">
        </div>

        <!-- <?php if(isset($error)): ?>
            <div>
                <p class="error"> <?php echo $error; ?></p>
            </div>
        <?php endif; ?> -->

        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <div class="profile-img-edit">
                    <img style="cursor:pointer" id="profile-display" src="./assets/rectangle.svg" onclick="triggerClick()">
                </div>
                <label class="clickable-text" style="cursor:pointer" for="image" onclick="triggerClick()">Add pic</label>
                <input type="file" id="profile-picture" name="image" style="display: none;" onchange="displayImage(this)">
            </div>

            <div class="input-spacing">
                <div class="form-field">
                    <div>
                        <label class="form-label" for="title">Title</label>
                    </div>
                    <div class="flex">
                        <input name="title" autocomplete="off" class="form-input" type="text" placeholder="Project X">
                    </div>
                    <div>
                        <label class="form-label" for="tags">Tags</label>
                    </div>
                    <div class="flex">
                        <input name="tags" autocomplete="off" class="form-input" type="text" placeholder="#optional">
                    </div>
                </div>
            </div>

          
            
            <div class="profile-edit">
                <a href="edit_profile.php" class="main-btn">Inspire others</a>
            </div>
        </form>
        <?php foreach($profile as $p): ?>
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
                    <a href="delete_profile.php?id=<?php echo $p['id']; ?>">
                        <img class="modal-icon" src="./assets/delete.svg" alt="delete">
                        <p>Delete your profile</p>
                    </a>
                </div>
            </section>
        <?php endforeach; ?>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
    <script src="./js/app.js"></script>
    
</body>
</html>