<?php 

include_once("bootstrap.php");

Security::onlyLoggedInUsers();
$email = $_SESSION['email'];

if( !empty($_POST) ){
    try {        
        // create a new user
        $user = new User();
        $user->setImage($_POST['image']);
        $user->setUsername($_POST['username']);
        $user->getEmail();
    }
    catch(Throwable $error) {
        // if any errors are thrown in the class, they can be caught here
        $error = $error->getMessage();
    }
}	


$profile = User::getProfileInfo($email);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <title>Folioo</title>
</head>

<body>
    <div id="home">
        <div>
            <img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo">
        </div>

        <!-- <div id="no-uploads">
            <img src="./assets/no-uploads.svg" alt="No uploads yet">
        </div> -->

        <article class="project">
            <img class="project-picture" src="./assets/no-uploads.svg" alt="comment icon">
            <div class="project-info">
                <a class="project-author" href="#">
                    <?php foreach($profile as $p): ?>
                        <img class="project-author-picture" src="./uploads/<?php echo $p['image']; ?>" alt="profile picture">
                        <h4 class="project-author-username"><?php echo $p['username']; ?></h4>
                    <?php endforeach; ?>
                </a>
                <div class="project-interactions">
                    <div class="project-interactions-like">
                        <img class="like-icon" src="./assets/heart-empty.svg" alt="heart or like icon">
                        <h4>number</h4>
                    </div>
                    <div class="project-interactions-comment">
                        <img class="comment-icon" src="./assets/comment.svg" alt="comment icon">
                        <h4>number</h4>
                    </div>
                </div>
            </div>
        </article>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>

    </div>
    

</body>

</html>