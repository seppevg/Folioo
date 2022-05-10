<?php
class ReportUser
{
    private $reportedUserId; //person that gets reported
    private $fromUserId; //person who reports


    /**
     * Get the value of reportedUserId
     */
    public function getReportedUserId()
    {
        return $this->reportedUserId;
    }

    /**
     * Set the value of reportedUserId
     *
     * @return  self
     */
    public function setReportedUserId($reportedUserId)
    {
        $this->reportedUserId = $reportedUserId;

        return $this;
    }

    /**
     * Get the value of fromUserId
     */
    public function getFromUserId()
    {
        return $this->fromUserId;
    }

    /**
     * Set the value of fromUserId
     *
     * @return  self
     */
    public function setFromUserId($fromUserId)
    {
        $this->fromUserId = $fromUserId;

        return $this;
    }

    public function reportUserAdd()
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO reportuser(reported_user_id, from_user_id) VALUES (:reportedUserId, :fromUserId);");
        $statement->bindValue(':reportedUserId', $this->reportedUserId);
        $statement->bindValue(':fromUserId', $this->fromUserId);
        return $statement->execute();
    }

    public function ReportUserDelete()
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM reportuser WHERE reported_user_id = :reportedUserId and from_user_id = :fromUserId;");
        $statement->bindValue(':reportedUserId', $this->reportedUserId);
        $statement->bindValue(':fromUserId', $this->fromUserId);
        return $statement->execute();
    }

    public static function checkIfReportedByUser($fromUserId, $reportedUserId)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT id FROM reportuser WHERE reported_user_id = :reportedUserId and from_user_id = :fromUserId;");
        $statement->bindValue(":reportedUserId", $reportedUserId);
        $statement->bindValue(":fromUserId", $fromUserId);
        $statement->execute();
        $count = $statement->rowCount();
        return $count;
    }
}
