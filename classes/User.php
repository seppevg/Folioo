<?php
class User implements iUser
{
    private $email;
    private $password;
    private $username;
    private $secondaryEmail;
    private $image;
    private $education;
    private $bio;
    private $instagramLink;
    private $behanceLink;
    private $linkedinLink;

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setSecondaryEmail($secondaryEmail)
    {
        $this->secondaryEmail = $secondaryEmail;
        return $this;
    }

    /**
     * Get the value of email
     */
    public function getSecondaryEmail()
    {
        return $this->secondaryEmail;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        if (strlen($password) < 6) {
            throw new Exception("Password must contain 6 or more characters 🔑");
        }
        $this->password = $password;
        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        if (empty($username)) {
            throw new Exception("Username can't be empty 👆");
        }
        $this->username = $username;
        return $this;
    }


    public function canLogin()
    {
        // this function checks if a user can login with the password and email provided
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email OR secondary_email = :email");
        $statement->bindValue(":email", $this->email);
        $statement->execute();
        $realUser = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$realUser) {
            throw new Exception("No user found with this email 🥸");
            return false;
        }
        $hash = $realUser["password"];
        if (password_verify($this->password, $hash)) {
            return true;
        } else {
            throw new Exception("Password is incorrect ❌");
            return false;
        }
    }

    public function canRegister()
    {
        //Checking if username is already used
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $statement->bindValue(":username", $this->username);
        $statement->execute();
        $resultUsername = $statement->rowCount();
        if ($resultUsername > 0) {
            throw new Exception("Username has already been used 🙈");
            return false;
        }

        //Checking if email is already used
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $statement->bindValue(":email", $this->email);
        $statement->execute();
        $resultEmail = $statement->rowCount();
        if ($resultEmail > 0) {
            throw new Exception("Email has already been used 🙈");
            return false;
        }

        //Checking if email is (not) empty
        if (empty($this->email)) {
            throw new Exception("Email can't be empty 👆");
            return false;
        }

        //Checking if email is from thomasmore
        if (stristr($this->email, '@student.thomasmore.be') == false && stristr($this->email, '@thomasmore.be') == false) {
            throw new Exception("Email has to contain @thomasmore.be or @student.thomasmore.be 🎓");
            return false;
        }

        return true;
    }

    public function validateEmail()
    {
        // this function checks if a user has entered a valid email
        if (empty($this->email)) {
            throw new Exception("Email can't be empty 👆");
            return false;
        }
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email OR secondary_email = :email");
        $statement->bindValue(":email", $this->email);
        $statement->execute();
        $realUser = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$realUser) {
            throw new Exception("No user found with this email 🥸");
            return false;
        }
        return true;
    }

    public function save()
    {
        $options = [
            'cost' => 15
        ];
        $password = password_hash($this->password, PASSWORD_DEFAULT, $options);
        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO users (email, password, username, image, followers) VALUES (:email, :password, :username, 'profiledefault.svg', 0);");
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':username', $this->username);
        return $statement->execute();
    }

    public function sendPasswordResetLink()
    {
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        $url = "http://localhost/php/folioo/reset_password.php?selector=" . $selector . "&validator=" . bin2hex($token);
        $expires = date("U") + 60 * 60 * 24;
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);

        $conn = DB::getInstance();
        $statement = $conn->prepare("DELETE FROM passwordreset WHERE Email=:email;");
        $statement->bindValue(':email', $this->email);
        $statement->execute();

        $conn = DB::getInstance();
        $statement = $conn->prepare("INSERT INTO passwordreset (Email, Selector, Token, Expires) VALUES (:email, :selector, :token, :expires);");
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':selector', $selector);
        $statement->bindValue(':token', $hashedToken);
        $statement->bindValue(':expires', $expires);
        $statement->execute();

        $to = $this->email;
        $subject = "Reset your password for Folioo";
        $message = "<h4>Password reset for Folioo</h4> </br></br>";
        $message .= "<p>Hi there, </br> We received a request to reset your password. </br> You can find the link to reset your password below. </br> If you didn't make this request, you can ignore this email.</p> </br>";
        $message .= "<p>Here is the link to reset your password: </br> <a href='" . $url . "'>" . $url . "</a></p>";
        $headers = "From: Folioo <info@folioo.com>\r\n";
        $headers .= "Reply-To: info@folioo.com\r\n";
        $headers .= "Content-type: text/html\r\n";
        mail($to, $subject, $message, $headers);

        return true;
    }

    public function resetPassword()
    {
        $selector = $_POST["selector"];
        $validator = $_POST["validator"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["password-repeat"];

        if (empty($password) || empty($passwordRepeat)) {
            throw new Exception("Password can't be empty 👆");
            return false;
        } elseif ($password != $passwordRepeat) {
            throw new Exception("Please repeat the same password.");
            return false;
        } elseif (strlen($password) < 6) {
            throw new Exception("Password must contain 6 or more characters 🔑");
        }
        $currentDate = date("U");
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM passwordreset WHERE Selector = :selector AND Expires >= :expires;");
        $statement->bindValue(':selector', $selector);
        $statement->bindValue(':expires', $currentDate);
        $statement->execute();
        $result = $statement->rowCount();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result <= 0) {
            throw new Exception("You need to re-submit your reset request");
            return false;
        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row['Token']);
            if ($tokenCheck === false) {
                throw new Exception("You need to re-submit your reset request");
                return false;
            } elseif ($tokenCheck === true) {
                $tokenEmail = $row["Email"];
                $conn = DB::getInstance();
                $statement = $conn->prepare("SELECT * FROM users WHERE email = :email;");
                $statement->bindValue(':email', $tokenEmail);
                $statement->execute();
                $result = $statement->rowCount();
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                if ($result <= 0) {
                    throw new Exception("There was an error finding your profile!");
                    return false;
                } else {
                    $conn = DB::getInstance();
                    $statement = $conn->prepare("UPDATE users SET password = :password WHERE email = :email;");
                    $options = [
                        'cost' => 15
                    ];
                    $newPasswordHash = password_hash($password, PASSWORD_DEFAULT, $options);
                    $statement->bindValue(':password', $newPasswordHash);
                    $statement->bindValue(':email', $tokenEmail);
                    $statement->execute();

                    $conn = DB::getInstance();
                    $statement = $conn->prepare("DELETE FROM passwordreset WHERE email = :email;");
                    $statement->bindValue(':email', $tokenEmail);
                    $statement->execute();
                    return true;
                }
            }
        }
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
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

    public static function getInfo($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE id = :id;");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    /**
     * Get the value of education
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * Set the value of education
     *
     * @return  self
     */
    public function setEducation($education)
    {
        $this->education = $education;
        return $this;
    }

    /**
     * Get the value of bio
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @return  self
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * Get the value of instagramLink
     */
    public function getInstagramLink()
    {
        return $this->instagramLink;
    }

    /**
     * Set the value of instagramLink
     *
     * @return  self
     */
    public function setInstagramLink($instagramLink)
    {
        $this->instagramLink = $instagramLink;
        return $this;
    }

    /**
     * Get the value of behanceLink
     */
    public function getBehanceLink()
    {
        return $this->behanceLink;
    }

    /**
     * Set the value of behanceLink
     *
     * @return  self
     */
    public function setBehanceLink($behanceLink)
    {
        $this->behanceLink = $behanceLink;
        return $this;
    }

    /**
     * Get the value of linkedinLink
     */
    public function getLinkedinLink()
    {
        return $this->linkedinLink;
    }

    /**
     * Set the value of linkedinLink
     *
     * @return  self
     */
    public function setLinkedinLink($linkedinLink)
    {
        $this->linkedinLink = $linkedinLink;
        return $this;
    }

    public function update()
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE users SET secondary_email = :secondary_email, image = :image, education = :education, bio = :bio, instagramlink = :instagramlink, behancelink = :behancelink, linkedinlink = :linkedinlink WHERE email = :email OR secondary_email = :email;");
        $statement->bindValue(':secondary_email', $this->secondaryEmail);
        $statement->bindValue(':image', $this->image);
        $statement->bindValue(':education', $this->education);
        $statement->bindValue(':bio', $this->bio);
        $statement->bindValue(':instagramlink', $this->instagramLink);
        $statement->bindValue(':behancelink', $this->behanceLink);
        $statement->bindValue(':linkedinlink', $this->linkedinLink);
        $statement->bindValue(':email', $this->email);
        return $statement->execute();
    }

    public static function delete($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare(
            "DELETE FROM users WHERE id = :id; 
            DELETE FROM posts WHERE user_id=:id;
            DELETE FROM likes WHERE user_id=:id;
            DELETE FROM comments WHERE user_id=:id;"
        );
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    public function validatePassword($id)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $realUser = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$realUser) {
            return false;
        }
        $hash = $realUser["password"];
        if (password_verify($this->password, $hash)) {
            return true;
        } else {
            throw new Exception("Password is incorrect ❌");
            return false;
        }
    }

    public function changePassword($id)
    {
        $password = $_POST["new-password"];
        $passwordRepeat = $_POST["new-password-repeat"];

        if (empty($password) || empty($passwordRepeat)) {
            throw new Exception("Password can't be empty 👆");
            return false;
        } elseif ($password != $passwordRepeat) {
            throw new Exception("Please repeat the same password.");
            return false;
        } elseif (strlen($password) < 6) {
            throw new Exception("Password must contain 6 or more characters 🔑");
        }

        $conn = DB::getInstance();
        $statement = $conn->prepare("UPDATE users SET password = :password WHERE id = :id;");
        $options = [
            'cost' => 15
        ];
        $newPasswordHash = password_hash($password, PASSWORD_DEFAULT, $options);
        $statement->bindValue(':password', $newPasswordHash);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    public static function getMainEmail($mail)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT email FROM users WHERE email = :email OR secondary_email = :email;");
        $statement->bindValue(':email', $mail);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getId($email)
    {
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT id FROM users where email = :email OR secondary_email = :email;");
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->rowCount();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result <= 0) {
            throw new Exception("You need to re-submit your request");
            return false;
        } else {
            return $row['id'];
        }
    }

    public static function addModerator($id){
        $conn = DB::getInstance();
        $statement = $conn->prepare("SELECT moderator FROM users where id = :id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->rowCount();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result <= 0) {
            throw new Exception("You need to re-submit your request");
            return false;
        } else {
            return $row['moderator'];
        }
    }
}
