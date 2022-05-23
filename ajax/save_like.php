<?php
    require_once('../bootstrap.php');

    if (!empty($_POST)) {
        $userId = $_POST['userId'];
        $postId = $_POST['postId'];

        try {
            $output = "";
            $conn = DB::getInstance();
            $statement = $conn->prepare("SELECT * FROM likes WHERE post_id = :postId AND user_id = :userId;");
            $statement->bindValue(":postId", $postId);
            $statement->bindValue(":userId", $userId);
            $statement->execute();
            $count = $statement->rowCount();

            if ($count > 0) {
                Like::unLike($postId, $userId);

                $result = [
                    "status" => "success",
                    "message" => "Unlike post"
                ];
            } else {
                Like::like($postId, $userId);

                $result = [
                    "status" => "success",
                    "message" => "Like was saved"
                ];
            }
        } catch (Throwable $e) {
            $result = [
                "error" => "error",
                "message" => "Like failed"
            ];
        }

        echo json_encode($result);
    }
