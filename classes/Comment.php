<?php
class Comment implements iProject
{
    public static function deleteAll($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM comments WHERE user_id=:id;");
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }
}