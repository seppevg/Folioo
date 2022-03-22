<?php 

include_once("bootstrap.php");
	
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
        <img src="./assets/Folioo.png" alt="Foolio Logo" class="logo">
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
                            <div>
                                <p class="error hidden">
                                    Email can't be empty
                                    <!-- 
                                    -password can't be empty
                                    -no user found with this email
                                    -password is incorrect
                                    -->
                                </p>
                            </div>

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