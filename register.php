<?php 

include_once("bootstrap.php");

if( !empty($_POST) ){
    try {        
        // create a new user
        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword(($_POST['password']));
        $user->setUsername(($_POST['username']));
        $user->save();
        
        // start a session and redirect the user
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

    <title>Folioo - Register</title>
</head>

<body class="form-background">
    <div>
        <!-- <img src="./assets/Folioo.png" alt="Foolio Logo" class="logo"> -->

        <div class="form">
            <form action="" method="post">
                <h3 class="form-title">Register</h3>

                <div class="form-field">
                    <label class="form-label" for="username">Username</label>
                    <input name="username" autofocus="" autocomplete="off" class="form-input" type="text" placeholder="den-David">
                </div>

                <div class="form-field">
                    <label class="form-label" for="email">Email</label>
                    <input name="email" autocomplete="off" class="form-input" type="email" placeholder="someone@thomasmore.be">
                </div>

                <div class="form-field">
                    <label class="form-label" for="password">Password</label>
                    <input name="password" autocomplete="off" class="form-input" type="password" placeholder="123456">
                </div>

                <?php if(isset($error)): ?>
                <div>
                    <p class="error"> <?php echo $error; ?>
                        <!-- Email has to contain @thomasmore.be or @student.thomasmore.be
                        Email can't be empty.
                        This email has already been used.
                        Username can't be empty
                        Username is already taken. 
                        Password can't be empty
                        Password must be at least 6 characters.
                        No user found with this email... -->
                       
                    </p>
                </div>
                <?php endif; ?>

                <div >
                    <input class="form-btn" type="submit" value="Register">
                </div>

                <div class="form-switch">
                    <p>Already an account?<a class="switch"href="#"> Log in</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>