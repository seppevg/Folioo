<?php
    require_once('../bootstrap.php');

    if(!empty($_POST)){

        $userId = $_POST['userId'];

        try {
            $output = "";
            $conn = DB::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE id = :userId;");
            $statement->bindValue(":userId", $userId);
            $statement->execute();
            $count = $statement->rowCount();

            if ($count > 0) {
                
                $conn = DB::getInstance();
                $statement = $conn->prepare("UPDATE users SET moderator = 1 WHERE id = :userId;");
                $statement->bindValue(":userId", $userId);
                $statement->execute();

                $result = [
                    "status" => "success",
                    "message" => "Remove moderator role"
                ];                

            } else {
                $conn = DB::getInstance();
                $statement = $conn->prepare("UPDATE users SET moderator = 0 WHERE id = :userId;");
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
                "message" => "Asign moderator failed"
            ];
        }

        echo json_encode($result);
    }