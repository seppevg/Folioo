<?php

include_once("bootstrap.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/style.css">
    <link rel="stylesheet" href="./styling/normalize.css">
    <title>Folioo - Forgot Password</title>
</head>

<body class="form-background">
    <div class="logo-row">
        <img src="./assets/folioo-white.svg" alt="Foolio Logo" class="logo">
    </div>
    <div class="form-container">
        <form action="" method="post" class="form">
            <div class="container">
                <div>
                    <h3 class="form-title">Forgot password?</h3>
                    <p>
                        No problem, we got you! Just fill in your email and we handle the rest. Check your mailbox and click the link!
                    </p>
                </div>

                <div id="filler">
                    <img src="./assets/password.svg" alt="lock and gear" width="180px">
                </div>

                <div>
                    <div>
                        <div>
                            <label class="form-label" for="email">Email</label>
                        </div>
                        <div class="flex">
                            <input name="email" autocomplete="off" class="form-input" type="email" placeholder="someone@thomasmore.be">
                        </div>
                    </div>

                    <div class="flex">
                        <input class="form-btn" type="submit" value="Send email">
                    </div>
                    <div class="switch-container">
                        <p class="center line">Didn't get a mail yet? <a class="switch" href="#">Send again</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>