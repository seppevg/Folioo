<?php
    require_once("../bootstrap.php");

    if (!empty($_POST)) {
        $projectStart = $_POST['projectStart'];

        try {
            $projects = Post::getPosts($projectStart);
            
            // success
            $result = [
                "status" => "success",
                "message" => "Loading is successfull",
                "data" => [
                    "projects" => $projects
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
    