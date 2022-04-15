<?php
class Post
{
    private $userId;
    private $title;
    private $text;
    private $image;
    private $tags;

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
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

    public static function getPosts($start)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT :start, 10;");
        $statement->bindValue(':start', (int)$start, PDO::PARAM_INT);
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

    public function save()
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO posts(user_id, title, tags, image, text) VALUES (:userId, :title, :tags, :image, :text);");
        $statement->bindValue(':userId', $this->userId);
        $statement->bindValue(':title', $this->title);
        $statement->bindValue(':tags', $this->tags);
        $statement->bindValue(':image', $this->image);
        $statement->bindValue(':text', $this->text);
        return $statement->execute();
    }

    public function getId()
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT count(id) FROM posts");
        $statement->execute();
        $postId = intval($statement->fetchColumn()) + 1;
        return $postId;
    }
}
