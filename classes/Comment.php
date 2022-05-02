<?php
class Comment implements iProject
{
    private $comment;
    
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
}
