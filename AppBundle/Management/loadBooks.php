<?php
require_once('Entity/EntityBooks.php');
$lines = array();
$entityBooks = new EntityBooks();
$lines = $entityBooks->getBooks();
echo json_encode(array("lines" => $lines));