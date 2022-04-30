<?php
    require_once("../bootstrap.php");

    if (!empty($_POST['id']) || !empty($_POST['userId'])) {
        $id = $_POST['id'];
        $userId = $_POST['userId'];

        try {
            $output = "";
            $conn = DB::getInstance();
            $statement = $conn->prepare("SELECT * FROM follow WHERE follower_id = :followerId AND following_id = :followingId;");
            $statement->bindValue(":followerId", $id);
            $statement->bindValue(":followingId", $userId);
            $statement->execute();
            $count = $statement->rowCount();

            if ($count > 0) {
                $conn = DB::getInstance();
                $statement = $conn->prepare("DELETE FROM follow WHERE follower_id = :followerId AND following_id = :followingId;");
                $statement->bindValue(":followerId", $id);
                $statement->bindValue(":followingId", $userId);
                $statement->execute();

                $result = [
                    "status" => "success",
                    "message" => "User has been unfollowed"
                ];
            } else {
                $conn = DB::getInstance();
                $statement = $conn->prepare("INSERT INTO follow (follower_id, following_id) VALUES (:followerId, :followingId);");
                $statement->bindValue(":followerId", $id);
                $statement->bindValue(":followingId", $userId);
                $statement->execute();

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
