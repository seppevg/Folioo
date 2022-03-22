<?php
    class User {
        private $email;
        private $password;
        private $username;
        private $secondaryEmail;

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
        public function setEmail($email)
        {
            //Checking if email is already used
            $conn = DB::getInstance();
            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $result = $statement->rowCount();
            if ( $result > 0 ){
                throw new Exception("Email has already been used.");
            }

            //Checking if email is (not) empty
            if(empty($email)){
                throw new Exception("Email can't be empty.");
            }    

            //Checking if email is from thomasmore
            if ( stristr($email, '@student.thomasmore.be') == false && stristr($email, '@thomasmore.be') == false ) {
                throw new Exception("Email has to contain @thomasmore.be or @student.thomasmore.be.");
            }

            $this->email = $email;
            return $this;
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
        public function setPassword( $password )
        {
                if(strlen($password) < 6){
                    throw new Exception("Password must contain 6 or more characters.");
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
            if(empty($username)){
                throw new Exception("Username can't be empty.");
            }
            $this->username = $username;
            return $this;
        }

        
        public function canLogin() {
            // this function checks if a user can login with the password and email provided
            $conn = DB::getInstance();
            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindValue(":email", $this->email);
            $statement->execute();
            $realUser = $statement->fetch(PDO::FETCH_ASSOC);
            if(!$realUser){
                return false;
            }
            $hash = $this->password;
            if(password_verify($this->password, $hash)){
                return true;
            }
            else{
               return false;
            }
        }

        public function save() {
            $options = [
                'cost' => 15
            ];
            $password = password_hash($this->password, PASSWORD_DEFAULT, $options);
            $conn = DB::getInstance();
            $statement = $conn->prepare("insert into users (email, password, username) values (:email, :password, :username);");
            $statement->bindValue(':email', $this->email);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':username', $this->username);
            return $statement->execute();
        }
    }