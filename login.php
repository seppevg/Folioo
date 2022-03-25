<?php 
include_once("bootstrap.php");

if( !empty($_POST) ){
    try {        
        // create a new user
        $user = new User();
        $user->setEmail(($_POST['email']));
        $user->setPassword(($_POST['password']));
        
        $user->canLogin();
        
        // if user is allowed to log in -> start a session and redirect the user
        session_start();
        $_SESSION['email'] = $user->getEmail();
        header("Location: index.php");
    }
    catch(Throwable $error) {
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
    <link rel="stylesheet" href="./styling/style.css">
    <link rel="stylesheet" href="./styling/normalize.css">
    <title>Folioo - Log in</title>
</head>

<body class="form-background">
    <div class="logo-row">
        <img src="./assets/folioo-white.png" alt="Foolio Logo" class="logo">
    </div>
            <div class="form-container">
                <form action="" method="post" class="form">
                    <div class="container">    
                        <div>
                            <h3 class="form-title">Log in</h3>

                            <div class="form-field">
                                <div>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                                <div class="flex">
                                    <input name="email" autocomplete="off" class="form-input" type="email" placeholder="someone@thomasmore.be">
                                </div>
                            </div>

                            <div class="form-field">
                                <div>
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="flex">
                                    <input name="password" autocomplete="off" class="form-input" type="password" placeholder="123456">
                                </div>
                            </div>
                        </div>

                        <div>
                            <?php if(isset($error)):?>
                                <div>
                                    <p class="error"> <?php echo $error ?>
                                        <!--Email can't be empty
                                        -password can't be empty
                                        -no user found with this email
                                        -password is incorrect
                                        -->
                                    </p>
                                </div>
                            <?php endif;?>

                            <div class="flex">
                                <input class="form-btn" type="submit" value="Log in">
                            </div>

                            <div class="center">
                                <a class="switch" href="#">Forgot password?</a>
                            </div>

                            
                            <div class="switch-container">
                                <p class="center line">No account yet? <a class="switch" href="register.php">Register</a></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

</body>

</html>