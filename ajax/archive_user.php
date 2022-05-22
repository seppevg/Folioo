<?php
require_once("../bootstrap.php");

if (!empty($_POST["user_id"])) {
    User::archiveUser($_POST["user_id"])
        ? $result = ["status" => "success", "message" => "User has been archived"]
        : $result = ["status" => "error", "message" => "There was an error archiving this user"];

    echo json_encode($result);
}