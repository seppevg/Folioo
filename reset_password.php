<?php

    include_once("bootstrap.php");


    $selector = $_GET["selector"];
    $validator = $_GET["validator"];

    if (empty($selector) || empty($validator)) {
        $error = "Could not validate your request!";
    } else {
        if (ctype_xdigit($selector) == false && ctype_xdigit($validator) == false) {
            $error = "Could not validate your request!";
        }
    }

    if (!empty($_POST)) {
        try {
            // create a new user
            $user = new User();
            $user->setPassword($_POST['password']);
            $user->resetPassword();
    
            // If the user entered a valid email he gets redirected
            header("Location: login.php");
        } catch (Throwable $error) {
            // if any errors are thrown in the class, they can be caught here
            $error = $error->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <title>Folioo - Reset Password</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
</head>

<body class="form-background">
    <div class="logo-row">
        <img src="./assets/folioo-white.svg" alt="Foolio Logo" class="logo">
    </div>

    <div class="form-container">
        <form action="" method="post" class="form">
            <input type="hidden" name="selector" value="<?php echo $selector; ?>">
            <input type="hidden" name="validator" value="<?php echo $validator; ?>">
            <div class="container">
                <div>
                    <h3 class="form-title">Reset password</h3>

                    <div class="form-field">
                        <div>
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="flex">
                            <input name="password" autocomplete="off" class="form-input" type="password" placeholder="Enter new password">
                        </div>
                        <div>
                            <label class="form-label" for="password">Repeat password</label>
                        </div>
                        <div class="flex">
                            <input name="password-repeat" autocomplete="off" class="form-input" type="password" placeholder="Repeat new password">
                        </div>
                    </div>
                </div>

                <div>
                    <?php if (isset($error)) : ?>
                        <div>
                            <p class="error"> <?php echo $error ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="flex">
                        <input name="reset-password-submit" class="form-btn" type="submit" value="Reset password">
                    </div>


                    <div class="switch-container">
                        <p class="center line">Don't forget it ;)</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>