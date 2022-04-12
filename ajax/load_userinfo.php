<?php
    require_once("../bootstrap.php");

    if (!empty($_POST)) {
        $userId = $_POST['userId'];

        try {
            $info = Post::getUserOfPost($userId);
            
            // success
            $result = [
                "status" => "success",
                "message" => "Loading is successfull",
                "data" => [
                    "info" => $info
                ]
            ];
        } 
        catch( Throwable $t ) {
            // error
            $result = [
                "status" => "error",
                "message" => "Something went wrong."
            ];
        }

        echo json_encode($result);

    }
    