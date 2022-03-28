<?php

include_once("bootstrap.php");

Security::onlyLoggedInUsers();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/style.css">
    <link rel="stylesheet" href="./styling/normalize.css">
    <title>Folioo</title>
</head>

<body>
    <div id="home">
        <div>
            <img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo">
        </div>
        <div id="no-uploads">
            <img src="./assets/no-uploads.svg" alt="No uploads yet">
        </div>

        <nav class="bottom-nav">
            <div class="nav-item">
                <div class="nav-img">
                    <img src="./assets/home.svg" alt="Home">
                </div>
                <div class="nav-link">
                    <a href="#">Home</a>
                </div>
            </div>
            <div class="nav-item">
                <div class="nav-img"> 
                    <img src="./assets/search.svg" alt="Search">
                </div>
                <div class="nav-link">
                    <a href="#">Search</a>
                </div>
            </div>
            <div class="nav-item">
                <div class="nav-img">
                    <img src="./assets/add.svg" alt="Add">
                </div>
                <div class="nav-link">
                    <a href="#">Add</a>
                </div>
            </div>
            <div class="nav-item">
                <div class="nav-img">
                    <img src="./assets/more.svg" alt="More">
                </div>
                <div class="nav-link">
                    <a href="#">Profile</a>
                </div>
            </div>
        </nav>
    </div>
    

</body>

</html>