<?php
    require_once('../bootstrap.php');

    if(!empty($_POST)){

        $userId = $_POST['userId'];

        try {
            $checkWarning = Warning::getWarningNumber($userId);

            if ($checkWarning > 0) {
                
                Warning::removeWarning($userId);

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