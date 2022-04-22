<?php

include_once("bootstrap.php");

Security::onlyLoggedInUsers();

//$email = $_SESSION['email'];
if (empty($_SESSION['email'])) {
    $email = "";
} else {
    $email = $_SESSION['email'];
}

$profile = User::getProfileInfo($email);

if (!empty($_POST)) {

    try {
        $post = new Post();
        $post->setUserId($profile[0]["id"]);
        $post->setTitle($_POST["title"]);
        $post->setText($_POST["text"]);
        $post->setTags($_POST["tags"]);

        $file = $_FILES['image'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error']; //Als er een error gebeurt moet het programma stoppen met het uploaden van de file
        $fileType = $file['type'];


        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png', 'svg');


        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = "post_" . $post->getId() . "." . $fileActualExt;
                    $fileDestination = 'uploads/posts/' . $fileNameNew;
                    $post->setImage($fileNameNew);
                    move_uploaded_file($fileTmpName, $fileDestination);
                } else {
                    echo "Your file is too big";
                }
            } else {
                echo "There was an error uploading your file";
            }
        } else {
            echo "You cannot upload a file of this type";
        }

        $post->save();


        header("Location: index.php");
    } catch (Throwable $error) {
        // if any errors are thrown in the class, they can be caught here
        $error = $error->getMessage();
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <title>Folioo - Add project</title>
</head>

<body>
    <div id="add">
        <?php if(!empty($email)):?>
            <div class="profile-header">
                <h3 class="profile-username">Add project</h3>
                <img class="modal-button" src="./assets/burger-menu.svg" alt="Burger menu">
            </div>

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
                            <label class="form-label" for="text">Text</label>
                        </div>
                        <div class="flex">
                            <input name="text" autocomplete="off" class="form-input" type="text" placeholder="My newest creation:)">
                        </div>
                        <div>
                            <label class="form-label" for="tags">Tags</label>
                        </div>
                        <div class="flex">
                            <input name="tags" autocomplete="off" class="form-input" type="text" placeholder="#optional">
                        </div>
                    </div>
                </div>

                <?php if(isset($error)): ?>
                    <div class="main-margin">
                        <p class="error"> <?php echo $error; ?></p>
                    </div>
                <?php endif; ?>

                <div class="profile-edit">
                    <button class="main-btn btn-add" type="submit">Inspire others</button>
                </div>
            </form>
            <?php foreach ($profile as $p) : ?>
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
        <?php endif;?>

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