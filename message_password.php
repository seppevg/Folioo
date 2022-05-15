<?php

include_once("bootstrap.php");

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
    <title>Folioo - Forgot Password</title>
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
                    <h3 class="form-title">Email has been send!</h3>
                    <p>
                        Your email has been send. Check your mailbox and click the link to reset your password!
                    </p>
                </div>

                <div id="filler">
                    <img src="./assets/password.svg" alt="lock and gear" width="180px">
                </div>
            </div>
        </form>
    </div>

</body>

</html>