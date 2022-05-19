<?php
class ReportPost
{
    private $postId;
    private $userId;


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


    public function reportPostAdd()
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO reportpost( post_id, user_id) VALUES (:postId, :userId);");
        $statement->bindValue(':postId', $this->postId);
        $statement->bindValue(':userId', $this->userId);
        return $statement->execute();
    }

    public function ReportPostDelete()
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM reportpost WHERE post_id = :postId and user_id = :userId;");
        $statement->bindValue(':postId', $this->postId);
        $statement->bindValue(':userId', $this->userId);
        return $statement->execute();
    }

    public static function checkIfReportedByUser($userId, $postId) {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT id FROM reportpost WHERE post_id = :postId AND user_id = :userId;");
        $statement->bindValue(":userId", $userId);
        $statement->bindValue(":postId", $postId);
        $statement->execute();
        $count = $statement->rowCount();
        return $count;
    }

    public function naughtyPosts(){
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT p.title, count(*) AS count FROM reportpost rp JOIN posts p ON rp.post_id = p.id Group by p.title ORDER BY count DESC;");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } 

}
