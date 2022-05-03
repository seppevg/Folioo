<?php
class Report
{
    public static function reportPost($postId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE posts SET reported = reported + 1 WHERE id = :id;");
        $statement->bindValue(':id', $postId);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function unReportPost($postId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE posts SET reported = reported - 1 WHERE id = :id;");
        $statement->bindValue(':id', $postId);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
