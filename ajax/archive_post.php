<?php

require_once("../bootstrap.php");

if (!empty($_POST["post_id"])) {
    Post::archivePost($_POST["post_id"])
        ? $result = ["status" => "success", "message" => "Post has been archived"]
        : $result = ["status" => "error", "message" => "There was an error archiving this post"];

    echo json_encode($result);
}
