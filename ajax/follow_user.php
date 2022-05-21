<?php
    require_once("../bootstrap.php");

    if (!empty($_POST['id']) || !empty($_POST['userId'])) {
        
        $id = $_POST['id'];
        $userId = $_POST['userId'];

        try {
            $output = Followers::check($id, $userId);
            // var_dump($output);

            if ($output == "Unfollow") {
                Followers::unfollow($id, $userId);

                $result = [
                    "status" => "success",
                    "message" => "User has been unfollowed"
                ];
            } else {
                Followers::follow($id, $userId);

                $result = [
                    "status" => "success",
                    "message" => "User has been followed"
                ];
            }
        } catch (Throwable $t) {
            $result = [
                "status" => "error",
                "message" => "Something went wrong."
            ];
        }

        echo json_encode($result);
    }
