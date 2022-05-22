<?php
    include_once("bootstrap.php");

    if ($_GET['id']) {
        $commentId = $_GET['id'];
        $postId = $_GET['postId'];

        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM comments WHERE id = :id;");
        $statement->bindValue(':id', $commentId);
        $result = $statement->execute();

        if ($result) {
            header("Location: post_detail.php?id=$postId");
        }
    }