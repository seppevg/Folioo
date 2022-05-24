<?php
    require_once('../bootstrap.php');

    if (!empty($_POST)) {
        $userId = $_POST['userId'];
        $postId = $_POST['postId'];

        try {
            $output = Like::liked($postId, $userId);

            if ($output > 0) {
                Like::unLike($postId, $userId);

                $result = [
                    "status" => "success",
                    "message" => "Unlike post"
                ];
            } else {
                Like::doLike($postId, $userId);

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
