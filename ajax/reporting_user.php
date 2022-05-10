<?php

require_once("../bootstrap.php");

if (!empty($_POST['reportedUserId']) && !empty($_POST['fromUserId']) && !empty($_POST['action'])) {
    // er is een postId
    $reportedUserId = $_POST['reportedUserId'];
    $fromUserId = $_POST['fromUserId'];
    $action = $_POST['action'];

    try {
        $post = User::getInfo($reportedUserId);
        if (sizeof($post) == 1) {
            // er is exact 1 post met deze ID
            try {
                if ($action == "report") {
                    $reportUser = new ReportUser();
                    $reportUser->setFromUserId($fromUserId);
                    $reportUser->setReportedUserId($reportedUserId);
                    $reportUser->reportUserAdd($reportedUserId, $fromUserId);
                    $result = [
                        "status" => "success",
                        "message" => "User has been reported."
                    ];
                } elseif ($action == "unreport") {
                    $reportUser = new ReportUser();
                    $reportUser->setFromUserId($fromUserId);
                    $reportUser->setReportedUserId($reportedUserId);
                    $reportUser->ReportUserDelete($reportedUserId, $fromUserId);
                    $result = [
                        "status" => "success",
                        "message" => "User has been unreported."
                    ];
                } else {
                    $result = [
                        "status" => "error",
                        "message" => "Something went wrong."
                    ];
                }
            } catch (Throwable $th) { //error bij het rapporteren van de user
                $result = [
                    "status" => "error",
                    "message" => "Something went wrong."
                ];
            }
        } else { //er is niet exact 1 user met die id
            $result = [
                "status" => "error",
                "message" => "User doesn't exist!"
            ];
        }
    } catch (Throwable $t) { //error bij het ophalen van de user
        $result = [
            "status" => "error",
            "message" => "Something went wrong."
        ];
    }
} else { //er is geen reportedUserId meegegeven
    $result = [
        "status" => "error",
        "message" => "Id or action not found!"
    ];
}

// if (value is 3) {
//     ->deze post is innapropriate
// }

echo json_encode($result);


