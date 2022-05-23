<?php
class Followers
{
    private $follower;
    private $following;

    /**
     * Get the value of follower
     */
    public function getFollower()
    {
        return $this->follower;
    }

    /**
     * Set the value of follower
     *
     * @return  self
     */
    public function setFollower($follower)
    {
        $this->follower = $follower;

        return $this;
    }

    /**
     * Get the value of following
     */
    public function getFollowing()
    {
        return $this->following;
    }

    /**
     * Set the value of following
     *
     * @return  self
     */
    public function setFollowing($following)
    {
        $this->following = $following;

        return $this;
    }

    public static function check($followerId, $followingId)
    {
        $output = "";
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM follow WHERE follower_id = :followerId AND following_id = :followingId;");
        $statement->bindValue(":followerId", $followerId);
        $statement->bindValue(":followingId", $followingId);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            $output = "Unfollow";
            return $output;
        } else {
            $output = "Follow";
            return $output;
        }
    }

    public static function getAll($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM follow WHERE follower_id = :id;");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getAllFollowers($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT count(*) as count FROM follow WHERE following_id = :id;");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public static function getAllFollowing($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT count(*) as count FROM follow WHERE follower_id = :id;");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public static function follow($id, $userId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO follow (follower_id, following_id) VALUES (:followerId, :followingId);");
        $statement->bindValue(":followerId", $id);
        $statement->bindValue(":followingId", $userId);
        $statement->execute();
    }

    public static function unfollow($id, $userId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM follow WHERE follower_id = :followerId AND following_id = :followingId;");
        $statement->bindValue(":followerId", $id);
        $statement->bindValue(":followingId", $userId);
        $statement->execute();
    }
}
