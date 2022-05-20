<?php session_start();

include_once("bootstrap.php");

$id = $_SESSION['id'];
$email = $_SESSION['email'];
$profile = User::getInfo($id);

if (!empty($_POST)) {
    try {
        $user = new User();
        if (!empty($_FILES['image']['name'])) {
            $imageName = Upload::uploadPicture($_FILES['image'], 'empty');
            $user->setImage($imageName);
        } else {
            $user->setImage($profile[0]['image']);
        }
        $user->setSecondaryEmail($_POST['secondary-email']);
        $user->setEducation($_POST['education']);
        $user->setBio($_POST['bio']);
        $user->setInstagramLink($_POST['instagram-link']);
        $user->setBehanceLink($_POST['behance-link']);
        $user->setLinkedinLink($_POST['linkedin-link']);
        $user->setEmail($email);
        $user->update();

        header("Location: profile.php");
    } catch (Throwable $error) {
        // if any errors are thrown in the class, they can be caught here
        $error = $error->getMessage();
    }
}

$isBanned = User::isBanned($id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <link rel="stylesheet" href="./styling/desktop.css">
    <title>Folioo - Profile</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>

<body>
<?php include_once("./includes/nav-top.inc.php"); ?>
    <div id="profile">
        <div class="profile-header">
            <h3 class="profile-username">Edit profile</h3>
            <img class="modal-button" id="modal_btn_ep" src="./assets/burger-menu.svg" alt="Burger menu">
        </div>
        <div class="form-container-edit-profile">
        <form action="" method="POST" enctype="multipart/form-data" class="web-flex">
            <?php foreach ($profile as $p) : ?>
                <div class="uploadzone-container">
                    <div class="profile-img profile-img-edit uploadzone-web">
                        <img style="cursor:pointer" id="profile-display" src="./uploads/profiles/<?php echo $p['image']; ?>" onclick="triggerClick()">
                    </div>
                    <label class="clickable-text" style="cursor:pointer" for="image" onclick="triggerClick()">Change profile picture</label>
                    <em class="specifications">  (Allowed extensions: jpg, jpeg, png, svg. File-size: max. 5 MB. Format: rectangle)</em>
                    <?php if (!empty($p['image'])) : ?>
                        <input type="file" id="profile-picture" name="image" style="display: none;" onchange="displayImage(this)" value="<?php echo htmlspecialchars($p['image']); ?>">
                    <?php else : ?>
                        <input type="file" id="profile-picture" name="image" style="display: none;" onchange="displayImage(this)">
                    <?php endif; ?>
                
                <?php if (isset($error)) : ?>
                    <div class="main-margin">
                        <p class="error"> <?php echo $error; ?></p>
                    </div>
                <?php endif; ?>
                </div>
                <div>
                    <div class="form-group">
                        <label class="form-label" for="secondary-email">Secondary email</label>
                        <?php if (!empty($p['secondary_email'])) : ?>
                            <input name="secondary-email" autofocus="" autocomplete="off" class="form-input" type="email" placeholder="Secondary email" value="<?php echo htmlspecialchars($p['secondary_email']); ?>">
                        <?php else : ?>
                            <input name="secondary-email" autofocus="" autocomplete="off" class="form-input" type="email" placeholder="Secondary email">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="education">Education</label>
                        <?php if (!empty($p['education'])) : ?>
                            <input name="education" autocomplete="off" class="form-input" type="text" placeholder="Education" value="<?php echo htmlspecialchars($p['education']); ?>">
                        <?php else : ?>
                            <input name="education" autocomplete="off" class="form-input" type="text" placeholder="Education">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="bio">Bio</label>
                        <?php if (!empty($p['bio'])) : ?>
                            <textarea style="resize: none;" rows="3" name="bio" autocomplete="off" class="form-input" type="text" placeholder="Bio"><?php echo htmlspecialchars($p['bio']); ?></textarea>
                        <?php else : ?>
                            <textarea style="resize: none;" rows="3" name="bio" autocomplete="off" class="form-input" type="text" placeholder="Bio"></textarea>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="instagram-link">Social Links</label>
                        <?php if (!empty($p['instagramlink'])) : ?>
                            <input name="instagram-link" autocomplete="off" class="form-input form-input-closer" type="text" placeholder="Instagram" value="<?php echo htmlspecialchars($p['instagramlink']); ?>">
                        <?php else : ?>
                            <input name="instagram-link" autocomplete="off" class="form-input form-input-closer" type="text" placeholder="Instagram">
                        <?php endif; ?>
                        <?php if (!empty($p['behancelink'])) : ?>
                            <input name="behance-link" autocomplete="off" class="form-input form-input-closer" type="text" placeholder="Behance" value="<?php echo htmlspecialchars($p['behancelink']); ?>">
                        <?php else : ?>
                            <input name="behance-link" autocomplete="off" class="form-input form-input-closer" type="text" placeholder="Behance">
                        <?php endif; ?>
                        <?php if (!empty($p['linkedinlink'])) : ?>
                            <input name="linkedin-link" autocomplete="off" class="form-input" type="text" placeholder="LinkedIn" value="<?php echo htmlspecialchars($p['linkedinlink']); ?>">
                        <?php else : ?>
                            <input name="linkedin-link" autocomplete="off" class="form-input" type="text" placeholder="LinkedIn">
                        <?php endif; ?>
                    </div>
                    <button class="main-btn" type="submit" name="save-user">Update profile</button>
                    </div>
        </div>
                <section class="modal modal-container ">
                    <div id="modal_ep" class="modal-content hidden">
                        <div class="modal-close" id="modal_close_ep">
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
                        <a href="#" class="delete-profile-popup">
                            <img class="modal-icon" src="./assets/delete.svg" alt="delete">
                            <p>Delete your profile</p>
                        </a>
                    </div>
                </section>
            <?php endforeach; ?>
        </form>
        <br><br><br><br><br><br><br><br>
        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>

    <script src="./js/filter.js"></script>
    <script src="./js/dropdown.js"></script>
    <script src="./js/modal.js"></script>
    <script src="./js/app.js"></script>
</body>

</html>