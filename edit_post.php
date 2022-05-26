<?php session_start();

include_once("bootstrap.php");

if (empty($_SESSION['id'])) {
    $id = "";
} else {
    $id = $_SESSION['id'];
}

$profile = User::getInfo($id);

if (empty($_GET['id'])) {
    header("Location: index.php");
}

$editPostId = $_GET['id'];
$oldPost = Post::getById($editPostId)[0];

if (empty($oldPost["id"])) {
    header("Location: index.php");
}

if (!empty($_POST)) {
    try {
        $newPost = new Post;
        $newPost->setId($oldPost["id"]);
        $newPost->setUserId($profile[0]["id"]);
        $newPost->setTitle($_POST["title"]);
        $newPost->setText($_POST["text"]);

        $tagArray = preg_split ("/\,/", $_POST["tags"]);
        $tagList = implode(', ', $tagArray);
        $newPost->setTags($tagList);        

        if ($_FILES['image']['name'] != "") {
            $imageName = Upload::uploadPicture($_FILES['image'], Upload::uid());
            $newPost->setImage($imageName);
            $imagePath = "./uploads/posts/" . $imageName;
            $extractor = new ColorExtractor();
            $extractor->setImage($imagePath)->setTotalColors(5)->setGranularity(10);
            $palette = $extractor->extractPalette();
            $colorPalette = implode(", ", $palette);
            $newPost->setColors($colorPalette);
        } else {
            $newPost->setImage($oldPost["image"]);
            $imagePath = "./uploads/posts/" . $oldPost["image"];
            $extractor = new ColorExtractor();
            $extractor->setImage($imagePath)->setTotalColors(5)->setGranularity(10);
            $palette = $extractor->extractPalette();
            $colorPalette = implode(", ", $palette);
            $newPost->setColors($colorPalette);
        }
        $newPost->update($editPostId);
        header("Location: index.php");
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
    <title>Folioo - Edit project</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>

<body>
<?php include_once("./includes/nav-top.inc.php"); ?>
    <div id="add">
        <?php if (!empty($id)) : ?>
            <div class="profile-header">
                <h3 class="profile-username">Edit project</h3>
                <img class="modal-button" src="./assets/burger-menu.svg" alt="Burger menu">
            </div>
            <div class="form-container form-container-add margin-web">
            <form action="" method="POST" enctype="multipart/form-data" class="web-flex">
                <div>
                    <div class="profile-img-edit">
                        <img style="cursor:pointer" id="profile-display" src="./uploads/posts/<?php if (!empty($oldPost)) {echo $oldPost['image'];} else {echo $newPost->getImage;} ?>" onclick="triggerClick()">
                    </div>
                    <label class="clickable-text" style="cursor:pointer" for="image" onclick="triggerClick()">Change pic</label>
                    <em class="specifications">  (Allowed extensions: jpg, jpeg, png, svg. File-size: max. 5 MB.)</em>
                    <input type="file" id="profile-picture" name="image" style="display: none;" onchange="displayImage(this)">
                </div>

                <div>
                    <div class="input-spacing">
                        <div class="form-field">
                            <div>
                                <label class="form-label" for="title">Title*</label>
                            </div>
                            <div class="flex">
                                <?php if (!empty($oldPost)) : ?>
                                    <input name="title" autocomplete="off" class="form-input" type="text" placeholder="Project X" value="<?php echo htmlspecialchars($oldPost['title']); ?>">
                                <?php else : ?>
                                    <input name="title" autocomplete="off" class="form-input" type="text" placeholder="Project X">
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="form-label" for="text">Text*</label>
                            </div>
                            <div class="flex">
                                <?php if (!empty($oldPost)) : ?>
                                    <input name="text" autocomplete="off" class="form-input" type="text" placeholder="My newest creation:)" value="<?php echo htmlspecialchars($oldPost['text']); ?>">
                                <?php else : ?>
                                    <input name="text" autocomplete="off" class="form-input" type="text" placeholder="My newest creation:)">
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="form-label" for="tags">Tags*</label>
                            </div>
                            <div class="flex">
                                <?php if (!empty($oldPost)) : ?>
                                    <input name="tags" autocomplete="off" class="form-input" type="text" placeholder="#LookAtThis" value="<?php echo htmlspecialchars($oldPost['tags']); ?>">
                                <?php else : ?>
                                    <input name="tags" autocomplete="off" class="form-input" type="text" placeholder="#LookAtThis">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($error)) : ?>
                        <div class="main-margin">
                            <p class="error"> <?php echo $error; ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="profile-edit">
                        <button class="main-btn" type="submit" name="save-post">Save Changes</button>
                    </div>
                </div>
            </form>
            </div>

            <?php foreach ($profile as $p) : ?>
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
                        <a href="#" class="delete-profile-popup">
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
    <script src="./js/delete.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/app.js"></script>
</body>

</html>