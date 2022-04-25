<?php 

    include_once("bootstrap.php");

    session_start();
    $id = $_SESSION['id'];
    $profile = User::getInfo($id);
    $email = $_SESSION['email'];


    if( !empty($_POST) ){
        try {        
            $user = new User();
            $user->setPassword($_POST['current-password']);
        
            $user->validatePassword($id);
            User::delete($id);
            //delete pictures from posts
            $filenamepost = "uploads/posts/" . $email . "_post" . "*";
            $fileinfoposts = glob($filenamepost); 
            // var_dump($fileinfoposts);
            foreach($fileinfoposts as $file) {
                unlink($file);
            }

            //delete profile picture
            $filename = "uploads/" . $email . "*";
            $fileinfo = glob($filename); 
            $fileext = explode(".", $fileinfo[0]);
            $fileactualext = $fileext[3];
            //var_dump($fileactualext);
        
            $file = "uploads/" . $email . "." . $fileactualext;
            //var_dump($file);
        
            if(!unlink($file)){
                echo "File was not deleted";
            }
            else {
                echo "File was deleted";
            }
                session_destroy();
                header("Location: register.php");
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
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <title>Folioo - Profile</title>
</head>
<body>
    <div id="profile">
    
        <div class="profile-header">
            <h3 class="profile-username">Delete profile</h3>
            <img class="modal-button" src="./assets/burger-menu.svg" alt="Burger menu">
        </div>
        <?php foreach($profile as $p): ?>
            <div class="profile-img profile-img-edit">                
                <div class="profile-img">                    
                    <img src="./uploads/<?php echo $p['image']; ?>">
                    <h3 class="clickable-text"><?php echo $p['username']; ?></h3>
                </div>
            </div>

            <form action="" method="post">
                <div class="profile-delete-confirmation">
                    <h4>Wait a minute!</h4>
                    <p>We need to make sure that you're the owner of the account before we 
                        delete it. Please enter your password.
                    </p>
                    
                    <div class="form-field">
                        <div>
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="flex">
                            <input name="current-password" autocomplete="off" class="form-input" type="password" placeholder="Enter password">
                        </div>
                    </div>
                    <div>
                        <?php if (isset($error)) : ?>
                            <div>
                                <p class="error"> <?php echo $error ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="profile-delete">
                            <button class="main-btn" type="submit" name="delete-user">Confirm</button>
                        </div>
                    </div>
                </div>
                

            </form>
        <?php endforeach; ?>

        <?php include_once("./includes/nav-bottom.inc.php"); ?>
    </div>
</body>
</html>