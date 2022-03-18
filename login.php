<!DOCTYPE html>
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
    <div>
        <!-- <img src="./assets/Folioo.png" alt="Foolio Logo" class="logo"> -->

        <div class="form">
            <form action="" method="post">
                <h3 class="form-title">Login</h3>

                <div class="form-field">
                    <label class="form-label" for="email">Email</label>
                    <input name="email" autocomplete="off" class="form-input" type="email" placeholder="someone@thomasmore.be">
                </div>

                <div class="form-field">
                    <label class="form-label" for="password">Password</label>
                    <input name="password" autocomplete="off" class="form-input" type="password" placeholder="123456">
                </div>

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

                <div>
                    <input class="form-btn" type="submit" value="Log in">
                </div>

                <div>
                    <a class="switch" href="#">Forgot password?</a>
                </div>

                <div class="form-switch">
                    <p>No account yet? <a class="forgot" href="#">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>