<?php
include_once("bootstrap.php");

if (empty($_GET['id'])) {
    $userId = "";
} else {
    $userId = $_GET['id'];
}

User::unban($userId);
header("Location: profile.php?id=$userId");
