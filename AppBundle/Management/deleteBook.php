<?php
require_once ("Model/ModelBooks.php");
$modelBooks = new ModelBooks();
$modelBooks->deleteBook(trim($_POST["id"],"\""));
if (!isset($_POST['mobile'])) {
    echo json_encode("ok");
}