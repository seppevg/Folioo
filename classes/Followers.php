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

    public static function getAll($id){
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM follow WHERE follower_id = :id;");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
