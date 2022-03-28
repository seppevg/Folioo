<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/style.css">
    <link rel="stylesheet" href="./styling/normalize.css">
    <title>Folioo - Reset Password</title>
</head>

<body class="form-background">
    <div class="logo-row">
        <img src="./assets/folioo-white.svg" alt="Foolio Logo" class="logo">
    </div>

    <div class="form-container">
        <form action="" method="post" class="form">
            <div class="container">
                <div>
                    <h3 class="form-title">Reset password</h3>

                    <div class="form-field">
                        <div>
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="flex">
                            <input name="password" autocomplete="off" class="form-input" type="password" placeholder="Must be at least 6 characters">
                        </div>
                        <div>
                            <label class="form-label" for="password">Repeat password</label>
                        </div>
                        <div class="flex">
                            <input name="password" autocomplete="off" class="form-input" type="password">
                        </div>
                    </div>
                </div>

                <div>
                    <?php if (isset($error)) : ?>
                        <div>
                            <p class="error"> <?php echo $error ?>
                                <!--Email can't be empty
                                -password can't be empty
                                -no user found with this email
                                -password is incorrect
                                -->
                            </p>
                        </div>
                    <?php endif; ?>

                    <div class="flex">
                        <input class="form-btn" type="submit" value="Save new password">
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