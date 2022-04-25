<?php

include_once("bootstrap.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styling/normalize.css">
    <link rel="stylesheet" href="./styling/style.css">
    <title>Folioo - Search</title>
</head>

<body>
    <div id="container-logo">
        <img id="full-logo" src="./assets/folioo-blue.svg" alt="Folioo logo">
    </div>

    <form class="search">
        <input type="text" name="search" placeholder="Search" class="inputSearch">
        <button type="submit" name="submit-search" class="searchbtn">Search</button>
    </form>

    <?php include_once("./includes/nav-bottom.inc.php"); ?>
</body>

</html>