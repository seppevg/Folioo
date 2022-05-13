<?php
    require_once('../bootstrap.php');

    if(!empty($_POST)){

        $userId = $_POST['userId'];

        try {
            $checkModerator = User::checkModeratorRole($userId);

            if ($checkModerator > 0) {
                
                $conn = DB::getInstance();
                $statement = $conn->prepare("UPDATE users SET moderator = 0 WHERE id = :userId;");
                $statement->bindValue(":userId", $userId);
                $statement->execute();

                $result = [
                    "status" => "success",
                    "message" => "Remove moderator role"
                ];                

            } else {
                $conn = DB::getInstance();
                $statement = $conn->prepare("UPDATE users SET moderator = 1 WHERE id = :userId;");
                $statement->bindValue(":userId", $userId);
                $statement->execute();

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