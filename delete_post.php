<?php 
    include_once("bootstrap.php");

    if ($_GET['postId']) {
        $postId = $_GET['postId'];

        //delete local image from post
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT image FROM posts WHERE id = :id;");
        $statement->bindValue(':id', $postId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $path = "uploads/posts/" . $result['image'];
        unlink($path);

        //delete post from database
        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM posts WHERE id = :id;");
        $statement->bindValue(':id', $postId);
        $result = $statement->execute();

        if ($result) {
            header("Location: index.php");
        }
    }
