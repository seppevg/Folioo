<?php
class Post
{
   
    public static function deleteAllPostsUser($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM posts WHERE user_id=:id;");
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }
}