<?php
require_once ("Model/ModelBooks.php");
$modelBooks = new ModelBooks();
if ($modelBooks->addRental($_POST['bookID'], $_POST['userID'])) {
    echo json_encode(array("message" => "ok"));
} else {
    echo json_encode(array("message" => "no"));
}