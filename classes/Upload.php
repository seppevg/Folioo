<?php
class Upload {
    public static function uploadProfilepicture($imageFile) {
        $getMail = $_SESSION['email'];
        $mainEmail = User::getMainEmail($getMail);
        $email = $mainEmail['email'];
    
        if(isset($_POST['save-user'])) {
            $file = $imageFile;
    
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name']; 
            $fileSize = $file['size'];
            $fileError = $file['error']; //Als er een error gebeurt moet het programma stoppen met het uploaden van de file
            $fileType = $file['type']; 
    
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png', 'svg');
    
            if(in_array($fileActualExt, $allowed)) {
                if($fileError === 0){
                    if($fileSize < 1000000) {
                        $fileNameNew = $email . "." . $fileActualExt;
                        $fileDestination = 'uploads/'. $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

                        $conn = DB::getInstance();
                        $statement = $conn->prepare("UPDATE users SET image = :fileNameNew WHERE email = :email");
                        $statement->bindValue(':fileNameNew', $fileNameNew);
                        $statement->bindValue(':email', $email);
                        $statement->execute();

                        header("Location: profile.php");
                        return $statement->fetchAll();
                    }
                    else {
                        throw new Exception("Your file is too big 🙈");
                        return false;
                    }
                }
                else {
                    throw new Exception("There was an error uploading your file ❌");
                    return false;
                }
            }
            else {
                throw new Exception("You cannot upload a file of this type ❌");
                return false;
            }
            return true;
        }
    }

    public static function uploadPostpicture($imageFile, $id) {
        $getMail = $_SESSION['email'];
        $mainEmail = User::getMainEmail($getMail);
        $email = $mainEmail['email'];
    
        if(isset($_POST['save-post'])) {
            $file = $imageFile;
    
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name']; 
            $fileSize = $file['size'];
            $fileError = $file['error']; //Als er een error gebeurt moet het programma stoppen met het uploaden van de file
            $fileType = $file['type']; 
    
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png', 'svg');
    
            if(in_array($fileActualExt, $allowed)) {
                if($fileError === 0){
                    if($fileSize < 1000000) {
                        $fileNameNew = $email . "_post" . $id . "." . $fileActualExt;
                        $fileDestination = 'uploads/posts/'. $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                    }
                    else {
                        throw new Exception("Your file is too big 🙈");
                        return false;
                    }
                }
                else {
                    throw new Exception("There was an error uploading your file ❌");
                    return false;
                }
            }
            else {
                throw new Exception("You cannot upload a file of this type ❌");
                return false;
            }
            return $fileNameNew;
        }
    }
}
    