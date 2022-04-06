<?php 

include_once("bootstrap.php");

Security::onlyLoggedInUsers();
$email = $_SESSION['email'];

if( !empty($_POST) ){
    try {        
        // create a new user
        $user = new User();
        $user->setImage($_POST['image']);
        $user->setUsername($_POST['username']);
        $user->getEmail();

    }
    catch(Throwable $error) {
        // if any errors are thrown in the class, they can be caught here
        $error = $error->getMessage();
    }

}	

$profile = User::getProfileImg($email);


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/style.css">
    <link rel="stylesheet" href="./styling/normalize.css">
    <title>Folioo - Profile</title>
</head>
<body>
    <?php foreach($profile as $p): ?>
        <div class="profileimg">
            <img src="./uploads/<?php echo $p['image']; ?>">
            <p><?php echo $p['username']; ?></p>
        </div>
    <?php endforeach; ?>
    
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image">
        <button type="submit" name="submit">Change profile picture</button>
    </form>

    <?php include_once("./includes/nav-bottom.inc.php"); ?>

</body>
</html>