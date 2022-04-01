<?php

    include_once("bootstrap.php");

    Security::onlyLoggedInUsers();
    $email = $_SESSION['email'];

    

    if(isset($_POST['submit'])) {
        $file = $_FILES['image'];

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
                    $statement = $conn->prepare("update users set image = '$fileNameNew' where email = '$email'");
                    $statement->execute();
                    header("Location: profile.php");
                    return $statement->fetchAll();
                }
                else {
                    echo "Your file is to big";
                }
            }
            else {
                echo "There was and error uploading your file"; 
            }
        }
        else {
            echo "You cannot upload file of this type";
        }
    }

