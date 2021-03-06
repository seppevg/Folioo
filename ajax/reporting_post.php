<?php

require_once("../bootstrap.php");

if (!empty($_POST['postId']) && !empty($_POST['userId']) && !empty($_POST['action'])) {
    // er is een postId
    $postId = $_POST['postId'];
    $userId = $_POST['userId'];
    $action = $_POST['action'];

    try {
        $post = Post::getById($postId);
        if (sizeof($post) == 1) {
            // er is exact 1 post met deze ID
            try {
                if ($action == "report") {
                    $reportPost = new ReportPost();
                    $reportPost->setUserId($userId);
                    $reportPost->setPostId($postId);
                    $reportPost->reportPostAdd($postId, $userId);
                    $result = [
                        "status" => "success",
                        "message" => "Post has been reported."
                    ];
                } elseif ($action == "unreport") {
                    $reportPost = new ReportPost();
                    $reportPost->setUserId($userId);
                    $reportPost->setPostId($postId);
                    $reportPost->ReportPostDelete($postId, $userId);
                    $result = [
                        "status" => "success",
                        "message" => "Post has been unreported."
                    ];
                } else {
                    $result = [
                        "status" => "error",
                        "message" => "Something went wrong."
                    ];
                }
            } catch (Throwable $th) { //error bij het rapporteren van de post
                $result = [
                    "status" => "error",
                    "message" => "Something went wrong."
                ];
            }
        } else { //er is niet exact 1 post met die id
            $result = [
                "status" => "error",
                "message" => "Post doesn't exist!"
            ];
        }
    } catch (Throwable $t) { //error bij het ophalen van de post
        $result = [
            "status" => "error",
            "message" => "Something went wrong."
        ];
    }
} else { //er is geen postId meegegeven
    $result = [
        "status" => "error",
        "message" => "Id or action not found!"
    ];
}

// if (value is 3) {
//     ->deze post is innapropriate
// }

echo json_encode($result);


