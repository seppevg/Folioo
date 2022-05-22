<?php
session_start();
include_once("bootstrap.php");
if (empty($_SESSION['id'])) {
    $id = "";
} else {
    $id = $_SESSION['id'];
}
$isBanned = User::isBanned($id);

$naughtyUsersInstance = new ReportUser;
$naughtyUsersArray = $naughtyUsersInstance->naughtyUsers();

$naughtyPostsInstance = new ReportPost;
$naughtyPostsArray = $naughtyPostsInstance->naughtyPosts();
$profile = User::getInfo($id);

$moderator = $profile[0]["moderator"];

if (!$moderator) {
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
    <title>Folioo - The naughty list</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>

<body>
    <?php include_once("./includes/nav-top.inc.php"); ?>

    <div class="profile-header">
        <h3 class="profile-username">The naughty list</h3>
    </div>
    <div class="tnl-container">
        <div id="naughty-title" class="hidden">
            <h2>👹 The naughty list 👹</h2>
        </div>

        <div>
            <h3>Naughty users:</h3>
            <ol type="1">
                <?php foreach ($naughtyUsersArray as $naughtyUser) : ?>
                    <?php if(!$naughtyUser["archived"]): ?>
                    <li id="naughty_user_<?php echo $naughtyUser["id"] ?>" onclick="archiveUser(this)" data-user-id="<?php echo $naughtyUser["id"] ?>">
                        <strong><?php echo htmlspecialchars($naughtyUser["username"]) ?></strong> times reported: <strong><?php echo htmlspecialchars($naughtyUser["count"]) ?></strong>
                        <img onclick="" style="width: 12px;" src="./assets/close.svg" alt="close">
                    </li>
                    <?php endif ?>
                <?php endforeach; ?>
            </ol>
        </div>

        <div>
            <h3>Naughty posts:</h3>
            <ol type="1">
                <?php foreach ($naughtyPostsArray as $naughtyPost) : ?>
                    <?php if(!$naughtyPost["archived"]): ?>
                        <li id="naughty_post_<?php echo $naughtyPost["id"] ?>" onclick="archivePost(this)" data-post-id="<?php echo $naughtyPost["id"] ?>">
                            <strong><?php echo htmlspecialchars($naughtyPost["title"]) ?></strong> times reported: <strong><?php echo htmlspecialchars($naughtyPost["count"]) ?></strong>
                            <img onclick="" style="width: 12px;" src="./assets/close.svg" alt="close">
                        </li>
                    <?php endif ?>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>


    <?php include_once("./includes/nav-bottom.inc.php"); ?>
    <script src="./js/filter.js"></script>
    <script src="./js/dropdown.js"></script>
    <script src="./js/naughty.js"></script>
</body>

</html>