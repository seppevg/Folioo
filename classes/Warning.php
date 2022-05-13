<?php
class Warning {

    private $text;
    private $userId; 

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        if (empty($text)) {
            throw new Exception("Reason can't be empty 👆");
        }
        $this->text = $text;

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

    public function Save(){
        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO warnuser (user_id, text) VALUES (:userId, :text);");
        $statement->bindValue(':userId', $this->userId);
        $statement->bindValue(':text', $this->getText());
        return $statement->execute();
    }

    public function updateWarning($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE users SET warning = 1 WHERE id = :id;");
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    public static function getWarningNumber($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT warning FROM users where id = :id;");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->rowCount();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result <= 0) {
            throw new Exception("You need to re-submit your request");
            return false;
        } else {
            return $row['warning'];
        }
    }
}