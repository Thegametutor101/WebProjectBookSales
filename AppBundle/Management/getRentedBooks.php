<?php
require_once ("Entity/EntityBooks.php");
$entityBooks = new EntityBooks();
echo json_encode(array("lines" => $entityBooks->getBooksRented($_POST['id'])));