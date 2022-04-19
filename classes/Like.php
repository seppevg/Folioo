<?php
class Like implements iProject
{
    public static function deleteAll($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM likes WHERE user_id=:id;");
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }
}