<?php
class Comment implements iProject
{
    private $comment;
    private $userId; 
    private $postId;
    
    public static function getAllCommentsPost($id){
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM comments WHERE post_id = :id;");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $comment = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comment;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    public function Save(){
        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO comments(post_id, user_id, comment) VALUES (:postId, :userId, :comment);");
        $statement->bindValue(':postId', $this->postId);
        $statement->bindValue(':userId', $this->userId);
        $statement->bindValue(':comment', $this->getComment());
        return $statement->execute();
    }

    public static function getUser($userId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT username, image FROM users WHERE id = :userId;");
        $statement->bindValue(':userId', $userId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByUserId($id){
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT user_id FROM comments WHERE post_id = :id;");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }

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
}
