<?php session_start();

include_once("bootstrap.php");

//$email = $_SESSION['email'];
if (empty($_SESSION['id'])) {
    $id = "";
} else {
    $id = $_SESSION['id'];
}

$profile = User::getInfo($id);

if (!empty($_POST)) {
    try {
        $post = new Post();
        $post->setUserId($profile[0]["id"]);
        $imageName = Upload::uploadPicture($_FILES['image'], Upload::uid());
        $post->setImage($imageName);
        $post->setTitle($_POST["title"]);
        $post->setText($_POST["text"]);

        //Set all tags in ordered string
        $tagArray = preg_split ("/\,/", $_POST["tags"]);
        $tagList = implode(', ', $tagArray);
        $post->setTags($tagList);

        //Set 5 must-used colors in ordered string
        $imagePath = "./uploads/posts/" . $imageName;
        $extractor = new ColorExtractor();
        $extractor->setImage($imagePath)->setTotalColors(5)->setGranularity(10);
        $palette = $extractor->extractPalette();
        $colorPalette = implode(", ", $palette);
        $post->setColors($colorPalette);

        $post->save();

        header("Location: index.php");
    } catch (Throwable $error) {
        // if any errors are thrown in the class, they can be caught here
        $error = $error->getMessage();
    }
}

$isBanned = User::isBanned($id);
if ($isBanned) {
    header("Location: index.php");
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
    <link rel="stylesheet" href="./styling/desktop.css">
    <title>Folioo - Add project</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>

<body>
    <?php include_once("./includes/nav-top.inc.php"); ?>
    <div id="add">
        <?php if (!empty($id)) : ?>
            <div class="profile-header">
                <h3 class="profile-username">Add project</h3>
                <img class="modal-button" id="modal_btn_add" src="./assets/burger-menu.svg" alt="Burger menu">
            </div>
            <div class="form-container form-container-add margin-web">
                <form action="" method="POST" enctype="multipart/form-data" class="web-flex">
                    <div>
                        <div class="profile-img-edit">
                            <img style="cursor:pointer" id="profile-display" src="./assets/rectangle.svg" onclick="triggerClick()">
                        </div>
                        <label class="clickable-text" style="cursor:pointer" for="image" onclick="triggerClick()">Add picture</label>
                        <em class="specifications">  (Allowed extensions: jpg, jpeg, png, svg. File-size: max. 5 MB.)</em>
                        <input type="file" id="profile-picture" name="image" style="display: none;" onchange="displayImage(this)">
                    </div>

                    <div class="margin-top-web">
                        <div class="input-spacing">
                            <div class="form-field">
                                <div>
                                    <label class="form-label" for="title">Title*</label>
                                </div>
                                <div class="flex">
                                    <?php if (!empty($_POST['title'])) : ?>
                                        <input name="title" autocomplete="off" class="form-input" type="text" placeholder="Title of my project" value="<?php echo htmlspecialchars($_POST['title']); ?>">
                                    <?php else : ?>
                                        <input name="title" autocomplete="off" class="form-input" type="text" placeholder="Title of my project">
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label class="form-label" for="text">Description*</label>
                                </div>
                                <div class="flex">
                                    <?php if (!empty($_POST['text'])) : ?>
                                        <textarea style="resize: none;" rows="3" name="text" autocomplete="off" class="form-input" type="text" placeholder="Enter a description for your project" value="<?php echo htmlspecialchars($_POST['text']); ?>"></textarea>
                                    <?php else : ?>
                                        <textarea style="resize: none;" rows="3" name="text" autocomplete="off" class="form-input" type="text" placeholder="Enter a description for your project"></textarea>
                                    <?php endif; ?>

                                </div>

                                <div class="tag-input">
                                    <div class="input">
                                        <label class="form-label" for="input-tags">Tags*</label>
                                        <div class="flex">
                                            <img src="./assets/hashtag.svg" class="input-icon">
                                            <input class="tags-input" type="text" placeholder="Tags (press enter after each tag)" name="input-tags" onkeydown="if (event.keyCode == 13) event.preventDefault();">
                                            <?php //if (!empty($post)):
                                            ?>
                                            <input style="display: none;" value="<?php if (!empty($_POST['tags'])) {
                                                                                        echo htmlspecialchars($_POST['tags']);
                                                                                    } ?>" name="tags" autocomplete="off" id="input-tags" type="text">
                                            <?php //endif;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="tag-list">
                                        <?php
                                        if (!empty($_POST['tags'])) : $tags = explode(",", $_POST['tags']);
                                            foreach ($tags as $tag) :
                                        ?>
                                                <div class="tag-item">
                                                    <span class="delete-btn" onclick="deleteTag(this, '${tag}')">&times;</span>
                                                    <span><?php echo htmlspecialchars($tag) ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php if (isset($error)) : ?>
                            <div class="main-margin">
                                <p class="error"> <?php echo $error; ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="profile-edit">
                            <button class="main-btn inspire" type="submit" name="save-post">Share project</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php foreach ($profile as $p) : ?>
                <section class="modal modal-container ">
                    <div id="modal_add" class="modal-content hidden">
                        <div class="modal-close" id="modal_close_add">
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
                        <a href="delete_profile.php" class="delete-profile-popup">
                            <img class="modal-icon" src="./assets/delete.svg" alt="delete">
                            <p>Delete your profile</p>
                        </a>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (empty($id)) : ?>
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

        <?php endif; ?>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
    <script src="./js/modal.js"></script>
    <script src="./js/filter.js"></script>
    <script src="./js/dropdown.js"></script>
    <script src="./js/app.js"></script>
</body>

</html>