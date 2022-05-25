<?php

include_once("bootstrap.php");

if (!empty($_POST)) {
    try {
        // create a new user
        if (!empty($_GET['shareCode'])) {
            $referralCode = $_GET['shareCode'];
        } else {
            $referralCode = "";
        }

        $currentDate = date("Y-m-d H:i:s");
        $dateArray = explode(" ", $currentDate );
        $options = [
            'cost' => 5
        ];
        $dayCode = password_hash($dateArray[0], PASSWORD_DEFAULT, $options);

        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setUsername($_POST['username']);
        $user->setImage($_POST['image']);
        $user->canRegister($referralCode, $dayCode);
        $user->save();
        
        // start a session and redirect the user
        session_start();
        $email = $_SESSION['email'] = $user->getEmail();
        $id = $_SESSION['id'] = $user->getId($email);
        //var_dump($id);
        header("Location: index.php");
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
    <link rel="stylesheet" href="./styling/desktop.css">
    <title>Folioo - Register</title>
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
                        <h3 class="form-title">Register</h3>

                        <div class="form-field">
                            <div>
                                <label class="form-label username-label" for="username">Username</label>
                            </div>
                            <div class="flex">
                                <input name="username" autofocus="" autocomplete="off" class="form-input" type="text" placeholder="Enter your username" id="ajax-username" oninput="checkUsername(this)">
                            </div>
                            <div>
                                <label class="form-label email-label" for="email">Email</label>
                            </div>
                            <div class="flex">
                                <input name="email" autocomplete="off" class="form-input" type="email" placeholder="Fill in your email" id="ajax-email" oninput="checkEmail(this)">
                            </div>
                        </div>

                        <div class="form-field">
                            <div>
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="flex">
                                <input name="password" autocomplete="off" class="form-input" type="password" placeholder="Use a strong password">
                            </div>
                        </div>

                        <div class="form-field">
                            <div class="flex">
                                <input type="hidden" name="image">
                            </div>
                        </div>
                    </div>

                    <div>                    
                        <?php if (isset($error)): ?>
                            <div>
                                <p class="error"> <?php echo $error; ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="flex">
                            <input class="form-btn" type="submit" value="Register">
                        </div>

                        <div class="switch-container">
                            <p class="center line">Already an account? <a class="switch" href="login.php">Log in</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script src="./js/app.js"></script>
</body>

</html>