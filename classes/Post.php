<?php
class Post
{
    private $userId;
    private $title;
    private $image;
    private $tags;

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
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of tags
     *
     * @return  self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Get the value of tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    public static function deleteAllPostsUser($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM posts WHERE user_id=:id;");
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    public static function getPosts($amount)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts LIMIT :amount;");
        $statement->bindValue(':amount', (int)$amount, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserOfPost($userId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT username, image FROM users WHERE id = :userId;");
        $statement->bindValue(':userId', $userId);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}