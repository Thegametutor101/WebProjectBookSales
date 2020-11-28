<?php
require_once ('Entity/EntityBooks.php');
$entityBook = new EntityBooks();
$lines = $entityBook->getBookById($_POST["id"]);
if (isset($_POST['mobile'])) {
    echo json_encode($lines[0]);
} else {
    echo json_encode(array("book" => $lines));
}