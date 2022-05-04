<?php
    require_once("../bootstrap.php");

    if(!empty($_POST)){
        $sessionId = $_SESSION['id'];
        $text = $_POST['comment'];

        try {
            $comment = new Comment();
            $comment->setComment($text);
            $comment->setUserId($sessionId);
            $comment->setPostId($_POST['postid']);
            $comment->Save();
    
            $result = [
                "status" => "success",
                "message" => "Comment saved",
                "data" => [
                    "comment" => htmlspecialchars($text)
                ]
            ];
        }
        catch (Throwable $t) {
            $result = [
                "status" => "error",
                "message" => "Something went wrong while saving your comment."
            ];
        }

        echo json_encode($result);

    }