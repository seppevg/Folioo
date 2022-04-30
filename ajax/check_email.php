<?php
    require_once("../bootstrap.php");

    if (!empty($_POST['email'])) {
        $email = $_POST['email'];

        try {
            $conn = DB::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $count = $statement->rowCount();
            if ($count > 0) {
                // success 1
                $result = [
                    "status" => "success",
                    "message" => "Email is already used"
                ];
            } else {
                // success 2
                $result = [
                    "status" => "success",
                    "message" => "Email is still free to use"
                ];
            }
        } catch (Throwable $t) {
            // error
            $result = [
                "status" => "error",
                "message" => "Something went wrong."
            ];
        }

        echo json_encode($result);
    }
