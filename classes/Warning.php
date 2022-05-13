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
}