<?php
    require_once("../bootstrap.php");

    if(!empty($_POST)){
        
        session_start();
        $sessionId = $_SESSION['id'];
        $text = $_POST['comment'];
        $postId = $_POST['postid'];

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
                    "comment" => htmlspecialchars($text)
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