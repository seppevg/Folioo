<?php
    require_once('../bootstrap.php');

    if(!empty($_POST)){
        session_start();
        $sessionId = $_SESSION['id'];
        $postId = $_POST['post'];

        try {
            $like = new Like();
            $like->setPostId($postId);
            $like->setUserId($sessionId);
            $like->Save();

            $response = [
                "status" => "success",
                "message" => "Like was saved"
            ];

        }
        catch(Throwable $e) {
            $response = [
                "error" => "error",
                "message" => "Like failed"
            ];
        }

        echo json_encode($response);
    }