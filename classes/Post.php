<?php
class Post implements iPost
{
    private $id;
    private $userId;
    private $title;
    private $text;
    private $image;
    private $tags;
    private $colors;

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

    /**
     * Set the value of colors
     *
     * @return  self
     */
    public function setColors($colors)
    {
        $this->colors = $colors;
        return $this;
    }

    /**
     * Get the value of colors
     */
    public function getColors()
    {
        return $this->colors;
    }

    public static function getAll($start)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT :start, 20;");
        $statement->bindValue(':start', (int)$start, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUser($userId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT id, username, image FROM users WHERE id = :userId;");
        $statement->bindValue(':userId', $userId);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO posts(user_id, title, text, image, tags, colors, showcase) VALUES (:userId, :title, :text, :image, :tags, :colors, 0);");
        $statement->bindValue(':userId', $this->userId);
        $statement->bindValue(':title', $this->title);
        $statement->bindValue(':text', $this->text);
        $statement->bindValue(':image', $this->image);
        $statement->bindValue(':tags', $this->tags);
        $statement->bindValue(':colors', $this->colors);
        return $statement->execute();
    }

    public function update()
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE posts SET user_id = :userId, title = :title, tags = :tags, image = :image, text = :text, colors = :colors WHERE id = :id;");
        $statement->bindValue(':id', $this->id);
        $statement->bindValue(':userId', $this->userId);
        $statement->bindValue(':title', $this->title);
        $statement->bindValue(':tags', $this->tags);
        $statement->bindValue(':image', $this->image);
        $statement->bindValue(':text', $this->text);
        $statement->bindValue(':colors', $this->colors);
        return $statement->execute();
    }

    public static function delete($email)
    {
    }

    public static function getAllFromUser($id, $start)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts WHERE user_id = :id ORDER BY showcase DESC, id DESC LIMIT :start, 10;");
        $statement->bindValue(":id", $id);
        $statement->bindValue(':start', (int)$start, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function search($searchRequest, $searchType)
    {
        if (empty($searchRequest)) {
            throw new Exception("Search can't be empty 👆");
            return false;
        }

        if (empty($searchType)) {
            $conn = DB::getInstance();
            $query = $conn->prepare("SELECT count(id) FROM posts WHERE title OR tags LIKE :keyword;");
            $query->bindValue(':keyword', '%' . $searchRequest . '%');
            $query->execute();
            $postId = intval($query->fetchColumn());
    
            if ($postId !== 0) {
                //return $postId;
                $conn = DB::getInstance();
                $statement = $conn->prepare("SELECT * FROM posts WHERE title OR tags LIKE :keyword ORDER BY id DESC;");
                $statement->bindValue(':keyword', '%' . $searchRequest . '%');
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $post[] = $row;
                }
                return $post;
            } else {
                throw new Exception("No posts found with this title or tag");
            }
        } elseif ($searchType == "Title") {
            $conn = DB::getInstance();
            $query = $conn->prepare("SELECT count(id) FROM posts WHERE Title LIKE :keyword;");
            $query->bindValue(':keyword', '%' . $searchRequest . '%');
            $query->execute();
            $postId = intval($query->fetchColumn());
    
            if ($postId !== 0) {
                //return $postId;
                $conn = DB::getInstance();
                $statement = $conn->prepare("SELECT * FROM posts WHERE Title LIKE :keyword ORDER BY id DESC;");
                $statement->bindValue(':keyword', '%' . $searchRequest . '%');
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $post[] = $row;
                }
                return $post;
            } else {
                throw new Exception("No posts found with this title");
            }
        } elseif ($searchType == "Tags") {
            $conn = DB::getInstance();
            $query = $conn->prepare("SELECT count(id) FROM posts WHERE Tags LIKE :keyword;");
            $query->bindValue(':keyword', '%' . $searchRequest . '%');
            $query->execute();
            $postId = intval($query->fetchColumn());
    
            if ($postId !== 0) {
                //return $postId;
                $conn = DB::getInstance();
                $statement = $conn->prepare("SELECT * FROM posts WHERE Tags LIKE :keyword ORDER BY id DESC;");
                $statement->bindValue(':keyword', '%' . $searchRequest . '%');
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $post[] = $row;
                }
                return $post;
            } else {
                throw new Exception("No posts found with this tag");
            }
        } elseif ($searchType == "Color") {
            $conn = DB::getInstance();
            $query = $conn->prepare("SELECT count(id) FROM posts WHERE Colors LIKE :keyword;");
            $query->bindValue(':keyword', '%' . $searchRequest . '%');
            $query->execute();
            $postId = intval($query->fetchColumn());
    
            if ($postId !== 0) {
                //return $postId;
                $conn = DB::getInstance();
                $statement = $conn->prepare("SELECT * FROM posts WHERE Colors LIKE :keyword ORDER BY id DESC;");
                $statement->bindValue(':keyword', '%' . $searchRequest . '%');
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $post[] = $row;
                }
                return $post;
            } else {
                throw new Exception("No posts found with this color");
            }
        }
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public static function checkShowcaseState($postId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT showcase FROM posts WHERE id = :postId;");
        $statement->bindValue(":postId", $postId);
        $statement->execute();
        $showcase = $statement->fetch(PDO::FETCH_ASSOC);
        return $showcase['showcase'];
    }

    public static function addToShowcase($postId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE posts SET showcase = 1 WHERE id = :postId;");
        $statement->bindValue(":postId", $postId);
        $statement->execute();
    }

    public static function removeFromShowcase($postId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE posts SET showcase = 0 WHERE id = :postId;");
        $statement->bindValue(":postId", $postId);
        $statement->execute();
    }

    public static function getAllShowcased($userId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts WHERE user_id = :userId AND showcase = 1 ORDER BY id DESC;");
        $statement->bindValue(":userId", $userId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function views($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE posts SET views = views + 1 WHERE id = :id;");
        $statement->bindValue(":id", $id);
        $statement->execute();
        
    }
}
