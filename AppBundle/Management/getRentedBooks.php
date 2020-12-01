<?php
require_once ("Entity/EntityBooks.php");
$entityBooks = new EntityBooks();
if (isset($_POST['mobile'])) {
    echo json_encode($entityBooks->getBooksRentedMobile($_POST['id']));
} else {
    echo json_encode(array("lines" => $entityBooks->getBooksRented($_POST['id'])));
}