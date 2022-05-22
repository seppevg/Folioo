<?php
    require_once("../bootstrap.php");

    if (!empty($_POST)) {
        session_start();
        $sessionId = $_SESSION['id'];
        $text = $_POST['comment'];
        $postId = $_POST['postid'];
        $username = $_POST['username'];
        $image = $_POST['image'];
        $number = $_POST['number'];
        $commentId = $_POST['commentid'];

        try {
            $c= new Comment();
            $c->setComment($text);
            $c->setUserId($sessionId);
            $c->setPostId($postId);
            $c->Save();
    
            $result = [
                "status" => "success",
                "message" => "Comment was saved.",
                "data" => [
                    "number" => $number,
                    "image" => $image,
                    "username" => $username,
                    "comment" => htmlspecialchars($text),
                    "commentid" => $commentId,
                    "postid" => $postId
                ]
            ];
        } catch (Throwable $t) {
            $result = [
                "status" => "error",
                "message" => "Something went wrong while saving your comment."
            ];
        }

        echo json_encode($result);
    }
