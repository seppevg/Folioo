<?php

include_once("bootstrap.php");

if (!empty($_POST)) {
    try {
        $user = new User();
        $user->setEmail($_POST['email']);
        $user->validateEmail();
        $user->sendPasswordResetLink();

        header("Location: index.php");
    } catch (Throwable $error) {
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
    <link rel="stylesheet" href="./styling/desktop.css">
    <title>Folioo - Invite Others</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>

<body class="form-background">
    <div class="logo-row">
        <img src="./assets/folioo-white.svg" alt="Foolio Logo" class="logo">
        <h2 class="slogan">Inspire and get inspired</h2>
    </div>
    <div class="form-container">
        <form action="" method="post" class="form">
            <div class="container">
                <div>
                    <h3 class="form-title">Invite a friend!</h3>
                    <p>
                        Share this link with someone who you would like to join Folioo. This link is only valid today.
                    </p>
                </div>

                <div id="invite-a-friend">
                    <img src="./assets/invite-friend.svg" alt="Invite a friend" width="180px">
                </div>

                <div id="invisible-link">
                    <?php 
                        $currentDate = date("Y-m-d H:i:s");
                        $dateArray = explode(" ", $currentDate );
                        $options = [
                            'cost' => 5
                        ];
                        $date = password_hash($dateArray[0], PASSWORD_DEFAULT, $options);
                    ?>
                    register.php?shareCode=<?php echo $date; ?>
                </div>

                <div class="flex">
                    <a class="share-url main-btn" id="copy-link-to-clipboard" href="#" onclick="copyLinkToClipboard()">
                        Copy link
                    </a>
                </div>
                <div class="switch-container">
                    <p class="center line">Friend invited? <a class="switch" href="profile.php">Return to profile</a></p>
                </div>
            </div>
        </form>
    </div>
    <script src="./js/app.js"></script>
</body>

</html>