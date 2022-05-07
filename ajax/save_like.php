<?php
    require_once('../bootstrap.php');

    if(!empty($_POST)){

        $userId = $_POST['user'];
        $postId = $_POST['post'];


        try {
            /*$like = new Like();
            $like->setPostId($postId);
            $like->setUserId($userId);
            $like->Save();*/
            $output = "";
            $conn = DB::getInstance();
            $statement = $conn->prepare("SELECT * FROM likes WHERE post_id = :postId AND user_id = :userId;");
            $statement->bindValue(":postId", $postId);
            $statement->bindValue(":userId", $userId);
            $statement->execute();
            $count = $statement->rowCount();

            if ($count > 0) {
                
                $conn = DB::getInstance();
                $statement = $conn->prepare("DELETE FROM likes WHERE post_id = :postId AND user_id = :userId;");
                $statement->bindValue(":postId", $postId);
                $statement->bindValue(":userId", $userId);
                $statement->execute();

                $result = [
                    "status" => "success",
                    "message" => "Onlike post"
                ];                

            } else {
                $conn = DB::getInstance();
                $statement = $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (:postId, :userId);");
                $statement->bindValue(":postId", $postId);
                $statement->bindValue(":userId", $userId);
                $statement->execute();

                $result = [
                    "status" => "success",
                    "message" => "Like was saved"
                ];
            }           

        }
        catch(Throwable $e) {
            $result = [
                "error" => "error",
                "message" => "Like failed"
            ];
        }

        echo json_encode($result);
    }