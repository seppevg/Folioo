<?php
    require_once("../bootstrap.php");

    if (!empty($_POST['username'])) {
        $username = $_POST['username'];

        try {
            $count = User::checkUsernameAvailability ($username);
            if ($count > 0) {
                // success 1
                $result = [
                    "status" => "success",
                    "message" => "Username is already used"
                ];
            } else {
                // success 2
                $result = [
                    "status" => "success",
                    "message" => "Username is still free to use"
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
