<?php
class Views
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

    public static function view($id, $userId)
    {
        
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM views WHERE post_id = :postId AND user_id = :userId;");
        $statement->bindValue(":postId", $id);
        $statement->bindValue(":userId", $userId);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            return false;
        } else {
            $conn = DB::getInstance();
            $statement = $conn->prepare("INSERT INTO views (post_id, user_id) VALUES (:postId, :userId);
            UPDATE posts SET views = views + 1 WHERE id = :postId;");
            $statement->bindValue(":postId", $id);
            $statement->bindValue(":userId", $userId);
            $statement->execute();
            
        }
    }
}