<?php
class Like implements iProject
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

    public function Save(){
        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (:postId, :userId);");
        $statement->bindValue(':postId', $this->getPostId());
        $statement->bindValue(':userId', $this->getUserId());
        return $statement->execute();
    }

    public static function getLikes($postId){
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT count(*) as count FROM likes WHERE post_id = :postId;");
        $statement->bindValue(":postId", $postId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
        
    }
}
