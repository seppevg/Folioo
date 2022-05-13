<?php
    require_once('../bootstrap.php');

    if(!empty($_POST)){

        $userId = $_POST['userId'];

        try {
            $checkWarning = Warning::getWarningNumber($userId);

            if ($checkWarning > 0) {
                
                $conn = DB::getInstance();
                $statement = $conn->prepare("UPDATE users SET warning = 0 WHERE id = :userId;
                UPDATE warnuser SET active = 0 WHERE user_id = :userId");
                $statement->bindValue(':userId', $userId);
                $statement->execute();

                $result = [
                    "status" => "success",
                    "message" => "Remove warning"
                ];                

            }         

        }
        catch(Throwable $e) {
            $result = [
                "error" => "error",
                "message" => "Remove warning failed"
            ];
        }

        echo json_encode($result);
    }