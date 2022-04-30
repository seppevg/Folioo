<?php
class Upload
{
    public static function uploadPicture($imageFile, $imageId)
    {
        $id = $_SESSION['id'];

        if (isset($_POST['save-user']) || isset($_POST['save-post'])) {
            if (empty($imageFile['name']) || $imageFile['name'] == "rectangle.svg") {
                throw new Exception("Image can't be empty 👆");
                return false;
            };

            $file = $imageFile;

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png', 'svg');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 1000000) {
                        //different naming and destination according to what the image will be used for
                        if (isset($_POST['save-user'])) {
                            $fileNameNew = $id . "." . $fileActualExt;
                            $fileDestination = 'uploads/profiles/' . $fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);
                        } elseif (isset($_POST['save-post'])) {
                            $fileNameNew = $id . "_post-" . $imageId . "." . $fileActualExt;
                            $fileDestination = 'uploads/posts/' . $fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);
                        }
                    } else {
                        throw new Exception("Your file is too big 🙈");
                        return false;
                    }
                } else {
                    throw new Exception("There was an error uploading your file ❌");
                    return false;
                }
            } else {
                throw new Exception("You cannot upload a file of this type ❌");
                return false;
            }
            return $fileNameNew;
        }
    }

    public static function uid($lenght = 13)
    {
        // uid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }
}
