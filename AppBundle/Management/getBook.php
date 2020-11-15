<?php
require_once ('Entity/EntityBooks.php');
$entityBook = new EntityBooks();
$lines = $entityBook->getBookById($_POST["id"]);
echo json_encode(array("book" => $lines));