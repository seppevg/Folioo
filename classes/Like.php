<?php
class Like
{
    private $userId;
    private $postId;

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of postId
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId
     *
     * @return  self
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    public static function getLikes($postId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT count(*) as count FROM likes WHERE post_id = :postId;");
        $statement->bindValue(":postId", $postId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public static function liked($postId, $userId)
    {
        $output = "";
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM likes WHERE post_id = :postId AND user_id = :userId;");
        $statement->bindValue(":postId", $postId);
        $statement->bindValue(":userId", $userId);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            $output = "1";
            return $output;
        } else {
            $output = "0";
            return $output;
        }
    }

    public static function unLike($postId, $userId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM likes WHERE post_id = :postId AND user_id = :userId;");
        $statement->bindValue(":postId", $postId);
        $statement->bindValue(":userId", $userId);
        $statement->execute();
    }

    public static function like($postId, $userId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (:postId, :userId);");
        $statement->bindValue(":postId", $postId);
        $statement->bindValue(":userId", $userId);
        $statement->execute();
    }
}
