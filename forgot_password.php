<?php

include_once("bootstrap.php");

if( !empty($_POST) ){
    try {        
        // create a new user
        $user = new User();
        $user->setEmail($_POST['email']);        
        $user->validateEmail();
        $user->sendPasswordResetLink();

        // If the user entered a valid email he gets redirected
        header("Location: message_password.php");
    }
    catch(Throwable $error) {
        // if any errors are thrown in the class, they can be caught here
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
                    <h3 class="form-title">Forgot your password?</h3>
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

                    <?php if(isset($error)):?>
                        <div>
                            <p class="error"> <?php echo $error ?></p>
                        </div>
                    <?php endif;?>

                    <div class="flex">
                        <input name="forgot-password" class="form-btn" type="submit" value="Send email">
                    </div>
                    <div class="switch-container">
                        <p class="center line">Didn't get a mail yet? <br> <a class="switch" href="#">Send again</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>