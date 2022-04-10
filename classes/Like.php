<?php
class Like
{
   
    public static function deleteAllLikesUser($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM likes WHERE user_id=:id;");
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }
}