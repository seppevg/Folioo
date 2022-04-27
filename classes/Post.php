<?php
class Post implements iPost
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
        if (empty($text)) {
            throw new Exception("Text can't be empty 👆");
        }
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
        if (empty($title)) {
            throw new Exception("Title can't be empty 👆");
        }
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
        if (empty($tags)) {
            throw new Exception("Tags can't be empty 👆");
        }
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

    public static function getAll($start)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT :start, 10;");
        $statement->bindValue(':start', (int)$start, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUser($userId)
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

    public function update()
    {

    }
        
    public static function delete($email) 
    {

    }

    public static function getAllUserPosts($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts WHERE user_id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getPostById($id){
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function searchPosts($search){
        $conn = DB::getInstance();
        $query = $conn->prepare("SELECT count(id) FROM posts WHERE title LIKE :keyword or tags LIKE :keyword;");
        $query->bindValue(':keyword', '%'.$search. '%');
        $query->execute();
        $postId = intval($query->fetchColumn());

        if($postId !== 0) {            
            //return $postId;
            $conn = DB::getInstance();
            $statement = $conn->prepare("SELECT * FROM posts WHERE title LIKE :keyword or tags LIKE :keyword;");
            $statement->bindValue(':keyword', '%'.$search. '%');
            $statement->execute();

            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $post[] = $row;
            }
            return $post;
            
        }
        else{
            throw new Exception("No posts found with this title or tag");
        }
    }

    public static function searchPostsByTitle($search){
        $conn = DB::getInstance();
        $query = $conn->prepare("SELECT count(id) FROM posts WHERE title LIKE :keyword;");
        $query->bindValue(':keyword', '%'.$search. '%');
        $query->execute();
        $postId = intval($query->fetchColumn());

        if($postId !== 0) {            
            //return $postId;
            $conn = DB::getInstance();
            $statement = $conn->prepare("SELECT * FROM posts WHERE title LIKE :keyword;");
            $statement->bindValue(':keyword', '%'.$search. '%');
            $statement->execute();

            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $post[] = $row;
            }
            return $post;
            
        }
        else{
            throw new Exception("No posts found with this title");
        }
    }

    public static function searchPostsByTags($search){
        $conn = DB::getInstance();
        $query = $conn->prepare("SELECT count(id) FROM posts WHERE tags LIKE :keyword;");
        $query->bindValue(':keyword', '%'.$search. '%');
        $query->execute();
        $postId = intval($query->fetchColumn());

        if($postId !== 0) {            
            //return $postId;
            $conn = DB::getInstance();
            $statement = $conn->prepare("SELECT * FROM posts WHERE tags LIKE :keyword;");
            $statement->bindValue(':keyword', '%'.$search. '%');
            $statement->execute();

            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $post[] = $row;
            }
            return $post;
            
        }
        else{
            throw new Exception("No posts found with this tag");
        }
    }
}
