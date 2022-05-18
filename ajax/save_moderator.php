<?php
    require_once('../bootstrap.php');

    if(!empty($_POST)){

        $userId = $_POST['userId'];

        try {
            $checkModerator = User::checkModeratorRole($userId);

            if ($checkModerator > 0) {                
                User::removeModerator($userId);

                $result = [
                    "status" => "success",
                    "message" => "Remove moderator role"
                ];                

            } else {                
                User::makeModerator($userId);

                $result = [
                    "status" => "success",
                    "message" => "Add moderator role"
                ];
            }           

        }
        catch(Throwable $e) {
            $result = [
                "error" => "error",
                "message" => "Assign moderator failed"
            ];
        }

        echo json_encode($result);
    }