<?php session_start();

include_once("bootstrap.php");

if (empty($_GET['id'])) {
    header("Location: welcome.php");
} else {
    $id = $_GET['id'];
}

$profile = User::getInfo($id);
$userProfiles = User::getInfo($id);
$posts = Post::getAllShowcased($id);
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
    <title>Folioo - Showcase</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>

<body>
    <nav class="top-nav">
        <div id="container-logo">
            <div class="dropdown">
                <a href="index.php"><img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo"></a>
            </div>
        </div>

        <div>
            <?php foreach ($profile as $p) : ?>
                <h3 class="showcase-username">Showcase: <?php echo htmlspecialchars($p['username']); ?></h3>
            <?php endforeach; ?>
        </div>

        <div class="user-links">
            <?php if(!empty($_SESSION['id'])):?>
                <?php if(!$isBanned): ?>
                <a class="main-btn add-project-nav" href="add.php">Share project</a>
                <?php endif; ?>
                <a href="profile.php" class="nav-user">
                        <?php $userImage = User::getInfo($_SESSION['id']); ?>
                        <?php foreach ($userImage as $uI): ?>
                            <img src="./uploads/profiles/<?php echo $uI['image']; ?>">
                        <?php endforeach; ?>
                </a>
                <button class="dropdown-button dropdown-button-profile">
                    <img class="dropdown-icon" src="./assets/dropdown.svg" alt="Dropdown arrow">
                </button>
                <div class="dropdown-menu-profile hidden">
                    <a href="showcase.php?id=<?php echo $_SESSION['id'];?>">
                        <img class="modal-icon" src="./assets/showcase.svg" alt="showcase">
                        <p>View showcase</p>
                    </a>
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
            <?php else: ?>
                <a class="main-btn login-nav-btn" href="login.php">Log in</a>
                <a class="main-btn register-nav-btn" href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </nav>

    <div id="profile-showcase">
        <?php foreach ($profile as $p) : ?>
            <?php if (!empty($id)) : ?>
                <?php if (empty($userId)) : ?>
                    <div class="profile-header">
                        <h3 class="profile-username">Showcase: <?php echo htmlspecialchars($p['username']); ?></h3>
                        <img class="modal-button" src="./assets/burger-menu.svg" alt="Burger menu">
                    </div>
                    <div class="profile-info">
                        <div class="profile-img profile-img-showcase">
                            <img src="./uploads/profiles/<?php echo $p['image']; ?>">
                        </div>
                        <div class="share-buttons">
                            <a class="share-mail main-btn" href="mailto:?subject=<Folioo Showcase>&body=<I Would like to share my shwocase page with you from my Folioo-account!>">
                                Share via mail
                            </a>
                            <a class="share-url main-btn" id="copy-to-clipboard" href="#" onclick="copyToClipboard()">
                                Share URL
                            </a>
                        </div>
                    </div>
                    <div class="profile-info-extra">
                        <p class="profile-text"><?php echo htmlspecialchars($p['education']); ?></p>
                        <div class="socials">
                            <?php if (!empty($p['instagramlink'])):?>
                                <a href="<?php echo htmlspecialchars($p['instagramlink']); ?>" target="_blank" rel="noopener noreferrer"><img src="./assets/instagram.svg" alt="Instagram icon" class="socialmedia-icons"></a>
                            <?php endif;?>
                            <?php if (!empty($p['behancelink'])):?>
                                <a href="<?php echo htmlspecialchars($p['behancelink']); ?>" target="_blank" rel="noopener noreferrer"><img src="./assets/behance.svg" alt="Behance icon" class="socialmedia-icons"></a>
                            <?php endif;?>
                            <?php if (!empty($p['linkedinlink'])):?>
                                <a href="<?php echo htmlspecialchars($p['linkedinlink']); ?>" target="_blank" rel="noopener noreferrer"><img src="./assets/linkedin.svg" alt="LinkdIn icon" class="socialmedia-icons"></a>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="profile-bio">
                        <p class="profile-text"><?php echo htmlspecialchars($p['bio']); ?></p>
                    </div>

                    <?php if (empty($posts)) : ?>
                        <div id="no-uploads">
                            <img src="./assets/no-posts.svg" alt="No posts yet">
                        </div>
                    <?php endif; ?>

                    <div class="allUserPosts feed">
                        <?php foreach ($posts as $post) : ?>
                            <article>
                                <a href="post_detail.php?id=<?php echo $post['id']; ?>" class="project">
                                    <img class="project-picture" src="./uploads/posts/<?php echo $post['image']; ?>" alt="project image">
                                </a>
                                <?php if (!empty($_SESSION['id'])): ?>
                                    <?php $showcaseState = Post::checkShowcaseState($post['id']); ?>
                                    <div class="project-picture-overlay" onclick="changeShowcaseState(<?php echo $post['id'];?>);">
                                        <svg id="project-picture-<?php echo $post['id']; ?>" class="showcase-icon <?php if ($showcaseState == "1") {echo 'showcase-icon-active';}; ?> " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 156.95 147.41"><defs><style>.d{stroke-miterlimit:10;stroke-width:2.33px;}</style></defs><g id="a"/><g id="b"><g id="c"><path class="d" d="M155.78,51.17v44.54c0,33.61-15.26,50.54-45.85,50.54h-1.1c-9.74,0-17.94-1.75-24.53-5.26-1.25-.68-2.43-1.43-3.56-2.17-.83-.59-1.57-1.16-2.35-1.78h-.03c-3.12-2.55-5.73-5.67-7.87-9.32-.33-.56-.65-1.16-.98-1.78-.09-.21-.21-.45-.33-.65-.27-.56-.53-1.16-.8-1.75-.09-.21-.18-.42-.27-.59-.33-.74-.62-1.51-.89-2.32-.03-.06-.03-.09-.06-.12-.3-.83-.59-1.72-.83-2.58-.3-.92-.53-1.84-.77-2.79-.24-.95-.45-1.93-.62-2.91-.39-1.99-.71-4.07-.95-6.21-.36-3.24-.53-6.68-.53-10.3V46c0-1.51-.06-2.91-.18-4.22-.12-1.34-.33-2.58-.59-3.74-.06-.33-.15-.65-.24-.95-.09-.36-.18-.68-.3-1.01-.18-.59-.42-1.16-.65-1.69-.12-.33-.3-.65-.48-.95-.15-.3-.33-.59-.5-.86-.39-.59-.77-1.1-1.22-1.57-.12-.18-.3-.36-.48-.53v-.03c-.68-.68-1.46-1.28-2.29-1.75-.42-.24-.86-.48-1.34-.65-.45-.24-.92-.42-1.43-.53-.48-.18-.98-.3-1.51-.42-.65-.15-1.31-.24-1.99-.33-.45-.06-.92-.09-1.4-.12-.59-.03-1.22-.06-1.84-.06-10.39,0-15.83,4.96-15.83,19.42v55.2c0,1.81,.09,3.5,.27,5.05,.03,.36,.09,.71,.12,1.04,.06,.36,.12,.71,.18,1.04,.12,.68,.27,1.34,.42,1.99,.09,.3,.15,.62,.27,.92,.06,.3,.18,.59,.3,.89,.15,.45,.33,.89,.5,1.31,.27,.56,.53,1.1,.83,1.57,.27,.45,.56,.89,.89,1.28,.33,.48,.71,.89,1.16,1.28,.3,.3,.65,.59,1.01,.86,.3,.24,.56,.42,.89,.59,.12,.09,.24,.18,.39,.21,.18,.15,.36,.24,.56,.33l.53,.27c.27,.12,.56,.24,.86,.33,.48,.18,.98,.33,1.51,.45,.3,.06,.56,.15,.86,.18,1.31,.27,2.73,.39,4.28,.39,.77,0,1.54-.03,2.26-.09,.71-.06,1.37-.15,2.02-.27,1.54-.27,2.97-.71,4.22-1.37l.06,.18c2.38,8.64,6.27,15.92,11.55,21.65l1.37,1.48c-1.48,.59-3.03,1.1-4.63,1.54-.95,.27-1.9,.5-2.91,.68-1.01,.21-2.02,.39-3.06,.56-1.04,.15-2.11,.3-3.21,.39-2.26,.24-4.6,.33-7.07,.33h-1.13c-.95,0-1.87-.03-2.79-.06-1.1-.03-2.2-.09-3.24-.18-.71-.06-1.4-.12-2.11-.21-.77-.09-1.51-.21-2.29-.33-.21-.03-.42-.06-.59-.09-.71-.12-1.4-.24-2.08-.39-1.01-.21-1.99-.45-2.94-.71-.98-.24-1.9-.53-2.82-.86-3.65-1.22-6.92-2.91-9.8-5.02-1.37-.95-2.64-2.02-3.83-3.21-.42-.39-.83-.83-1.22-1.25-.39-.42-.77-.86-1.16-1.34-.3-.33-.56-.68-.83-1.04-.18-.21-.36-.45-.5-.68-.3-.36-.56-.74-.8-1.13-2.46-3.65-4.39-7.9-5.73-12.77-.18-.53-.33-1.07-.45-1.63-.33-1.28-.62-2.58-.86-3.92-.24-1.28-.45-2.58-.59-3.92-.15-1.16-.27-2.32-.39-3.53,0-.27-.03-.53-.03-.8-.12-1.07-.18-2.17-.21-3.27-.06-1.37-.09-2.79-.09-4.22V51.17C1.16,18.12,15.39,1.16,45.7,1.16h2.97c1.19,0,2.32,.03,3.44,.09,.83,.03,1.66,.09,2.46,.15,.48,.03,.92,.06,1.37,.12,.92,.09,1.81,.21,2.67,.33,2.08,.33,4.04,.71,5.94,1.25,.95,.24,1.84,.53,2.76,.83,.89,.3,1.75,.62,2.61,.98,.83,.36,1.66,.74,2.46,1.16,.74,.39,1.46,.77,2.14,1.19s1.37,.86,2.02,1.31c.62,.45,1.28,.92,1.81,1.37v.03c10.16,8.08,15.11,21.94,15.11,41.22v50.04c0,4.1,.45,7.48,1.34,10.27,.18,.56,.39,1.13,.62,1.63,.18,.53,.42,1.01,.71,1.48,.24,.48,.53,.89,.83,1.31,.3,.42,.62,.8,.95,1.16,2.61,2.82,6.41,4.1,11.4,4.1,10.96,0,16.39-5.79,16.39-19.95V46c0-14.46-5.7-19.42-16.39-19.42-.74,0-1.48,.03-2.2,.09-.45,.03-.89,.06-1.34,.15-1.57,.21-3.03,.59-4.31,1.16v-.03c-2.32-8.79-6.27-16.21-11.7-22.06l-1.43-1.54c1.48-.59,3.06-1.1,4.69-1.48,1.01-.27,2.05-.48,3.12-.68,.21-.03,.45-.09,.68-.12,.83-.15,1.72-.27,2.61-.39,.33-.03,.68-.09,1.01-.12,.98-.12,1.96-.18,2.97-.24,.21-.03,.45-.03,.65-.03,1.28-.09,2.55-.12,3.89-.12h3c1.78,0,3.5,.06,5.17,.18,.12,0,.24,0,.33,.03,.89,.06,1.75,.15,2.61,.24,.86,.09,1.69,.21,2.52,.36,1.43,.21,2.82,.5,4.16,.83,.45,.12,.92,.24,1.37,.36,1.72,.48,3.39,1.04,4.96,1.72,.39,.15,.77,.33,1.13,.48,.8,.36,1.57,.74,2.35,1.19,.53,.27,1.04,.56,1.54,.89,.62,.36,1.22,.74,1.81,1.19,.98,.68,1.93,1.46,2.85,2.23,.53,.45,1.01,.89,1.51,1.43,.3,.3,.59,.59,.89,.92,.09,.09,.21,.18,.27,.3,.33,.36,.65,.71,.95,1.1,.36,.39,.68,.8,.98,1.25,.36,.42,.65,.83,.95,1.28,.8,1.19,1.54,2.41,2.26,3.71,.59,1.1,1.13,2.26,1.63,3.47,.68,1.63,1.28,3.36,1.81,5.14,.45,1.54,.86,3.15,1.19,4.84,.24,1.1,.42,2.26,.59,3.41,.06,.33,.12,.68,.15,1.04,.18,1.16,.3,2.35,.42,3.56,.12,1.13,.18,2.29,.24,3.47,.03,.45,.06,.89,.06,1.37,.06,1.31,.09,2.67,.09,4.04Z"/></g></g></svg>
                                    </div>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    <section class="modal modal-container ">
                        <div id="modal" class="modal-content hidden">
                            <div class="modal-close">
                                <img class="modal-icon" src="./assets/close.svg" alt="close">
                            </div>
                            <a href="profile.php">
                                <img class="modal-icon" src="./assets/feed.svg" alt="showcase">
                                <p>View my profile</p>
                            </a>
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
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="./js/masonry.js"></script>
    <script src="./js/dropdown.js"></script>
    <script src="./js/app.js"></script>
</body>

</html>