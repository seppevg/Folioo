<?php
include_once("bootstrap.php");

if (empty($_GET['id'])) {
    $userId = "";
} else {
    $userId = $_GET['id'];
}

User::ban($userId);
header("Location: profile.php?id=$userId");
