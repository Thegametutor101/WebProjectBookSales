<?php
require_once ("Model/ModelBooks.php");
$modelBooks = new ModelBooks();
if ($modelBooks->deleteRental($_POST['bookID'], $_POST['userID'])) {
    if (isset($_POST['mobile'])) {
        echo json_encode("ok");
    } else {
        echo json_encode(array("message" => "ok"));
    }
} else {
    if (isset($_POST['mobile'])) {
        echo json_encode("no");
    } else {
        echo json_encode(array("message" => "no"));
    }
}