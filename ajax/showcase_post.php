<?php
    require_once("../bootstrap.php");
    if (isset($_POST['postId']) && isset($_POST['state'])) {
        $postId = $_POST['postId'];
        $showcaseState = $_POST['state'];
        try {
            if ($showcaseState == "1") {
                Post::removeFromShowcase($postId);
                $result = [
                    "status" => "success",
                    "message" => "Post has been removed from showcase"
                ];
            } else {
                Post::addToShowcase($postId);
                $result = [
                    "status" => "success",
                    "message" => "Post has been added to showcase"
                ];
            }
        } catch (Throwable $t) {
            $result = [
                "status" => "error",
                "message" => "Something went wrong updating the showcase."
            ];
        }

        echo json_encode($result);
    }
