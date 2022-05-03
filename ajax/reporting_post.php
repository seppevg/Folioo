
<?php
require_once("../bootstrap.php");

if (!empty($_POST['postId']) && !empty($_POST['action'])) {
    // er is een postId
    $id = $_POST['postId'];
    $action = $_POST['action'];

    try {
        $post = Post::getById($id);
        if (sizeof($post) == 1) {
            // er is exact 1 post met deze ID
            try {
                if ($action == "report") {
                    Report::reportPost($id);
                    $result = [
                        "status" => "success",
                        "message" => "Post has been reported."
                    ];
                } elseif ($action == "unreport") {
                    Report::unReportPost($id);
                    $result = [
                        "status" => "success",
                        "message" => "Post has been unreported."
                    ];
                } else {
                    $result = [
                        "status" => "error",
                        "message" => "Something went wrong."
                    ];
                }
            } catch (Throwable $th) { //error bij het rapporteren van de post
                $result = [
                    "status" => "error",
                    "message" => "Something went wrong."
                ];
            }
        } else { //er is niet exact 1 post met die id
            $result = [
                "status" => "error",
                "message" => "Post doesn't exist!"
            ];
        }
    } catch (Throwable $t) { //error bij het ophalen van de post
        $result = [
            "status" => "error",
            "message" => "Something went wrong."
        ];
    }
} else { //er is geen postId meegegeven
    $result = [
        "status" => "error",
        "message" => "Id or action not found!"
    ];
}

echo json_encode($result);
